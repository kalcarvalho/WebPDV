<?php

include_once '../domain/Sistema.class.php';

class DAO {

    protected $dao = null;
    protected $con = null;
    protected $sql = null;
    protected $host = null;
    protected $dbname = null;
    protected $user = null;
    protected $password = null;
    protected $sistema = null;
    protected $index = "codigo";
    protected $table = "";
    protected $columns = array();
    protected $search = array();
    protected $join = array();
    
    
    public function __construct($sistema) {
        $this->sistema = $sistema;
        
    }
    
    public function setIndex($index) {
        $this->index = $index;
    }
    
    public function getIndex() {
        return $this->index;
    }
    
    public function setColumns($columns) {
        $this->columns = $columns;
    }
    
    public function getColumns() {
        return $this->columns;
    }
    
    public function setTable($table) {
        $this->table = $table;
    }
    
    public function getTable() {
        return $this->table;
    }
    
    public function setSearch($search) {
        $this->search = $search;
    }
    
    public function getSearch() {
        return $this->search;
    }
    
    public function setJoin($join) {
        $this->join = $join;
    }
    
    public function getJoin() {
        return $this->join;
    }
    
    public function getSistema() {
        return $this->sistema();
    }
    

    // public function getInstance() {
        // if ($this->dao == null) {
            // $this->openConnection();
            // $dao = $this;
        // }
        // return $dao;
    // }
    
    public function setupConnection($sistema) {
        
        $this->host = $sistema->getHost();
        $this->dbname = $sistema->getDBName();
        $this->user = $sistema->getUser();
        $this->password = $sistema->getPassword(); 
        $this->sistema = $sistema;
    }

    

    public function openConnection() {
    

        try {
            
            $this->setupConnection($this->sistema);
            
            #echo __DIR__ . '\\' . $config;

            $this->con = new PDO(
                'mysql:host='.$this->host.';dbname='.$this->dbname.'',
                $this->user,
                $this->password
            );
            
            $this->con->exec("SET NAMES utf8");
            
            if(!$this->con) throw new Exception("Não foi possível contectar-se à base de dados.");
            return $this->con;

        } catch(PDOException $e ) {
        
            
            echo $e->getLine() ." ". $e->getMessage(); //tratar  p/ arquivo de log
            exit();
            
        } catch(Excetion $e) {
            echo $e->getMessage();
            exit();
        }

    }
    
    protected function closeConnection() {
        if($this->con != null) $this->con = null;
    }

    public function __destruct() {
        $this->sistema = null;
        $this->closeConnection();
    }
    
    // protected function execute($rs, $fields, $types) {
        // for($i=0; $i<count($fields); $i++) $rs->bindParam($i+1,$fields[$i], $types[$i]);
        // $rs->execute();
        // return $rs;
    // }
    
    
    protected function listAllAjaxSearch($request) {
    
        $columns = $this->getColumns();
        $index = $this->getIndex();
        $table = $this->getTable();
        $search = $this->getSearch();
    
        $where = $this->filtering($request);
        $sort = $this->ordering($request);
        $limit = $this->paging($request);
        $total = 0;
        $filtered = 0;
        
        
        try {
        
            $sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $search))."
                    FROM  $table
                    $where
                    $sort
                    $limit";
                    
                    
                    
            $stmt = $this->openConnection();
             
            $rs = $stmt->prepare($sql);
            
            // Bind parameters
            if ( isset($request['sSearch']) && $request['sSearch'] != "" ) {
                $rs->bindValue(':search', '%'.$request['sSearch'].'%', PDO::PARAM_STR);
            }
            for ( $i=0 ; $i<count($columns) ; $i++ ) {
                if ( isset($request['bSearchable_'.$i]) && $request['bSearchable_'.$i] == "true" && $request['sSearch_'.$i] != '' ) {
                    $rs->bindValue(':search'.$i, '%'.$request['sSearch_'.$i].'%', PDO::PARAM_STR);
                }
            }
             
            $rs->execute();
            $result = $rs->fetchAll();
            $rs->closeCursor();
            
            
            $filtered = current($stmt->query('SELECT FOUND_ROWS()')->fetch());
            
            
            // Get total number of rows in table
            $total = current($stmt->query("SELECT COUNT($index) FROM $table ")->fetch());
            
            
            $output = $this->makeJsonOutput($request['sEcho'], $total, $filtered, $result);
            
            return $output;
            
         
        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
    
    /* 
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    private function filtering($request) {
    
        $columns = $this->getColumns();
    
        $where = "";
        if ( isset($request['sSearch']) && $request['sSearch'] != "" ) {
            $where = "WHERE (";
            for ( $i=0 ; $i<count($columns) ; $i++ ) {
                if ( isset($request['bSearchable_'.$i]) && $request['bSearchable_'.$i] == "true" ) {
                    $where .= "`".$columns[$i]."` LIKE :search OR ";
                }
            }
            $where = substr_replace( $where, "", -3 );
            $where .= ')';
        }
         
        // Individual column filtering
        for ( $i=0 ; $i<count($columns) ; $i++ ) {
            if ( isset($request['bSearchable_'.$i]) && $request['bSearchable_'.$i] == "true" && $request['sSearch_'.$i] != '' ) {
                if ( $where == "" ) {
                    $where = "WHERE ";
                }
                else {
                    $where .= " AND ";
                }
                $where .= "`".$columns[$i]."` LIKE :search".$i." ";
            }
        }
        
        return $where;
    
    
    }
    
    private function paging($request) {
    
        $limit = "";
        if ( isset( $request['iDisplayStart'] ) && $request['iDisplayLength'] != '-1' ) {
            $limit = "LIMIT ".intval( $request['iDisplayStart'] ).", ".intval( $request['iDisplayLength'] );
        }
        
        return $limit;
        
    }
    
    /*
     * Ordering
     */
    public function ordering($request) {
    
        $sort = "";
        
        $columns = $this->getColumns();
    
        if ( isset( $request['iSortCol_0'] ) ) {
            $sort = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $request['iSortingCols'] ) ; $i++ ) {
                if ( $request[ 'bSortable_'.intval($request['iSortCol_'.$i]) ] == "true" ) {
                    $sortDir = (strcasecmp($request['sSortDir_'.$i], 'ASC') == 0) ? 'ASC' : 'DESC';
                    $sort .= "`".$columns[ intval( $request['iSortCol_'.$i] ) ]."` ". $sortDir .", ";
                }
            }
             
            $sort = substr_replace( $sort, "", -2 );
            if ( $sort == "ORDER BY" ) {
                $sort = "";
            }
        }
        
        return $sort;
    
    }
    
    private function makeJsonOutput($echo, $total, $filtered, $rs) {
    
        $columns = $this->getColumns();
        $join = $this->getJoin();
        $search = $this->getSearch();
    
        // Output
        $output = array(
            "sEcho" => intval($echo),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $filtered,
            "aaData" => array()
        );
        
        // Return array of values
        foreach($rs as $aRow) {
            $row = array();        
            for ( $i = 0; $i < count($columns); $i++ ) {
                if ( $columns[$i] == "version" ) {
                    // Special output formatting for 'version' column
                    $row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
                }
                else if ( $columns[$i] != ' ' ) {
                    
                    
                    if(array_key_exists($columns[$i], $join)) {
                        $row[] = $join[ $columns[$i] ][$aRow[ $columns[$i] ]];
                        
                    } else {
                        if($aRow[ $i ] == 'action') {
                            $row[] = '<button class="btn btn-large btn-danger" disabled onclick="RemoveTableRow(this)" type="button">Ação</button>';
                        } else {
                            $row[] = $aRow[ $columns[$i] ];
                        }
                    }
                    
                }
            }
            
            $output['aaData'][] = $row;
        }
        
        
        return $output;
    
    }
    
    
}

?>
