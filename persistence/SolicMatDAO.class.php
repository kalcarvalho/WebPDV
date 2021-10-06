<?php

include_once '../domain/SolicMat.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class SolicMatDAO extends DAO implements IDatabaseFinder {


    public function findByPK($pk) {
		try {
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare("SELECT sma_solicitacaomaterial.* 
								 FROM sma_solicitacaomaterial  
								 WHERE sma_codigo = ?
								 ");
			
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$row = $rs->fetch(PDO::FETCH_OBJ);

				$sm = new SolicMat();
				$sm->setCodigo($row->sma_codigo);
				$sm->setUsuario($row->sma_usuario);
				$sm->setContrato($row->sma_contrato);
				$sm->setCcusto($row->sma_centrodecusto);
				$sm->setReferencia($row->sma_referencia);
				$sm->setObservacao($row->sma_observacao);
				$sm->setDescLocal($row->sma_desclocal);
				$sm->setData($row->sma_data);
				$sm->setAtendida($row->sma_atendida);
				$sm->setAutorizada($row->sma_autorizada);
				$sm->setDataAtend($row->sma_dataatend);
				$sm->setDataCancel($row->sma_datacancel);
				$sm->setAutorizadoPor($row->sma_autorizadopor);
				$sm->setDataAutoriz($row->sma_dataautoriz);
				$sm->setAutorizante($row->sma_autorizante);
				$sm->setLocal($row->sma_local);
				$sm->setAutorizadaEm($row->sma_autorizadaem);
				$sm->setEmpresa($row->sma_empresa);
				$sm->setLiberada($row->sma_liberada);

				return $sm;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function findByPKFormatted($pk) {
		try {
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare(
				"SELECT sma_solicitacaomaterial.*, 
					ctr_descricao, 
					loc_descricao, 
					usu_nome
				FROM sma_solicitacaomaterial 
				LEFT OUTER JOIN ctr_contrato      ON ctr_codigo  = sma_contrato
					LEFT OUTER JOIN ccu_centrodecusto ON ccu_codigo = sma_centrodecusto
					LEFT OUTER JOIN usu_usuario ON usu_codigo = sma_usuario
					LEFT OUTER JOIN loc_local ON loc_codigo = sma_local								 
					WHERE sma_codigo = ?
					ORDER BY sma_autorizadaem DESC
								 ");
			
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$row = $rs->fetch(PDO::FETCH_OBJ);

				$sm = new SolicMat();
				$sm->setCodigo($row->sma_codigo);
				$sm->setUsuario($row->usu_nome);
				$sm->setContrato($row->ctr_descricao);
				$sm->setCcusto($row->sma_centrodecusto);
				$sm->setReferencia($row->sma_referencia);
				$sm->setObservacao($row->sma_observacao);
				$sm->setDescLocal($row->sma_desclocal);
				$sm->setData($row->sma_data);
				$sm->setAtendida($row->sma_atendida);
				$sm->setAutorizada($row->sma_autorizada);
				$sm->setDataAtend($row->sma_dataatend);
				$sm->setDataCancel($row->sma_datacancel);
				$sm->setAutorizadoPor($row->sma_autorizadopor);
				$sm->setDataAutoriz($row->sma_dataautoriz);
				$sm->setAutorizante($row->sma_autorizante);
				$sm->setLocal($row->loc_descricao);
				$sm->setAutorizadaEm($row->sma_autorizadaem);
				$sm->setEmpresa($row->sma_empresa);
				$sm->setLiberada($row->sma_liberada);

				return $sm;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function findBackupByPKFormatted($pk) {
		try {
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare(
				"SELECT smb_smbackup.*, 
					ctr_descricao, 
					loc_descricao, 
					usu_nome
				FROM smb_smbackup 
				LEFT OUTER JOIN ctr_contrato      ON ctr_codigo  = smb_contrato
					LEFT OUTER JOIN ccu_centrodecusto ON ccu_codigo = smb_centrodecusto
					LEFT OUTER JOIN usu_usuario ON usu_codigo = smb_usuario
					LEFT OUTER JOIN loc_local ON loc_codigo = smb_local								 
					WHERE smb_codigo = ?
					ORDER BY smb_autorizadaem DESC
								 ");
			
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$row = $rs->fetch(PDO::FETCH_OBJ);

				$sm = new SolicMat();
				$sm->setCodigo($row->smb_codigo);
				$sm->setUsuario($row->usu_nome);
				$sm->setContrato($row->ctr_descricao);
				$sm->setCcusto($row->smb_centrodecusto);
				$sm->setReferencia($row->smb_referencia);
				$sm->setObservacao($row->smb_observacao);
				$sm->setDescLocal($row->smb_desclocal);
				$sm->setData($row->smb_data);
				$sm->setAtendida($row->smb_atendida);
				$sm->setAutorizada($row->smb_autorizada);
				$sm->setDataAtend($row->smb_dataatend);
				$sm->setDataCancel($row->smb_datacancel);
				$sm->setAutorizadoPor($row->smb_autorizadopor);
				$sm->setDataAutoriz($row->smb_dataautoriz);
				$sm->setAutorizante($row->smb_autorizante);
				$sm->setLocal($row->loc_descricao);
				$sm->setAutorizadaEm($row->smb_autorizadaem);
				$sm->setEmpresa($row->smb_empresa);
				$sm->setLiberada($row->smb_liberada);

				return $sm;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	

    public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT oco_ordemcompra.*
                                 FROM oco_ordemcompra 
								 ORDER BY oco_referencia DESC limit 100
                                 ");
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$ordem = new OrdemCompra();
					$ordem->setCodigo($row->oco_codigo);
					$ordem->setReferencia($row->oco_referencia);
					$ordem->setFornecedor($row->oco_fornecedor);
					$ordem->setDataOC($row->oco_data);
					$ordem->setAutorizada($row->oco_autorizada);
					$ordem->setEntrega($row->oco_dataentrega);
					$ordem->setRevisada($row->oco_revisada);
					
					array_push($list, $ordem);
					
				}
				
				return $list;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listAllSMsAfter($date, $qtype, $query, $sort, $limit, &$total=NULL) {
		try {
            
            $stmt = $this->openConnection();
			
			$sql = "SELECT sma_solicitacaomaterial.* FROM sma_solicitacaomaterial ";
			
			if( $qtype == '' || $query == '' ) {
			
				
				$sql .= "WHERE DATE_FORMAT(STR_TO_DATE(sma_data, '%d/%m/%Y'), '%Y-%m-%d') >= ? 
						  ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
				
				$rs = $stmt->prepare($sql); 
									 
				$rs->bindParam(1, $date, PDO::PARAM_STR);
				
				
			} else {
			
				$sql .= "WHERE DATE_FORMAT(STR_TO_DATE(sma_data, '%d/%m/%Y'), '%Y-%m-%d') >= ? AND $qtype=$query
							ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
							
				$rs = $stmt->prepare($sql); 
			
				$rs->bindParam(1, $date, PDO::PARAM_STR);
			
			}
			
			
								 
			$rs->execute();
			
			if(isset($total)) {
			
				// $xFile = '../temp/sql.ini';
				// ($fp = fopen($xFile, 'w')) or exit(0); 
				// fwrite($fp, $sql);
				// fclose($fp);

				$total = $rs->rowCount();
				return NULL;
					
			}
			
            if($rs->rowCount() > 0){
			
				
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$sm = new SolicMat();
					$sm->setCodigo($row->sma_codigo);
					$sm->setUsuario($row->sma_usuario);
					$sm->setContrato($row->sma_contrato);
					$sm->setCcusto($row->sma_centrodecusto);
					$sm->setReferencia($row->sma_referencia);
					$sm->setObservacao($row->sma_observacao);
					$sm->setDescLocal($row->sma_desclocal);
					$sm->setData($row->sma_data);
					$sm->setAtendida($row->sma_atendida);
					$sm->setAutorizada($row->sma_autorizada);
					$sm->setDataAtend($row->sma_dataatend);
					$sm->setDataCancel($row->sma_datacancel);
					$sm->setAutorizadoPor($row->sma_autorizadopor);
					$sm->setDataAutoriz($row->sma_dataautoriz);
					$sm->setAutorizante($row->sma_autorizante);
					$sm->setLocal($row->sma_local);
					$sm->setAutorizadaEm($row->sma_autorizadaem);
					$sm->setEmpresa($row->sma_empresa);
					$sm->setLiberada($row->sma_liberada);
					
					array_push($list, $sm->getCodigo());
					
				}
				
				return $list;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	
	public function listAllowedSMsAfterYear($date) {
		try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT sma_solicitacaomaterial.*
                                 FROM sma_solicitacaomaterial 
								 WHERE sma_autorizada > 0 
								 AND DATE_FORMAT(STR_TO_DATE(sma_data, '%d/%m/%Y'), '%Y') >= ? 
								 AND ISNULL(sma_datacancel)
								 ORDER BY sma_referencia DESC "); 
								 
			$rs->bindParam(1, $date, PDO::PARAM_INT);
			
			$rs->execute();
			
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					array_push($list, $row->sma_codigo);
					
				}
				
				return $list;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	
	public function listSMsBackupContingence($query, $year) {
	
		try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT DISTINCT smb_smbackup.*
                                 FROM smb_smbackup 
								 WHERE smb_codigo NOT IN(?)
								 AND ISNULL(smb_datacancel) 
								 AND smb_empresa = 1 
								 AND DATE_FORMAT(STR_TO_DATE(smb_data, '%d/%m/%Y'), '%Y') >= ? 
								 ORDER BY smb_referencia DESC "); 
								 
			$rs->bindParam(1, $query, PDO::PARAM_STR);
			$rs->bindParam(2, $year, PDO::PARAM_INT);
			
			$rs->execute();
           
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
				 
					$sm = new SolicMat();
					$sm->setCodigo($row->smb_codigo);
					$sm->setUsuario($row->smb_usuario);
					$sm->setContrato($row->smb_contrato);
					$sm->setCcusto($row->smb_centrodecusto);
					$sm->setReferencia($row->smb_referencia);
					$sm->setObservacao($row->smb_observacao);
					$sm->setDescLocal($row->smb_desclocal);
					$sm->setData($row->smb_data);
					$sm->setAtendida($row->smb_atendida);
					$sm->setAutorizada($row->smb_autorizada);
					$sm->setDataAtend($row->smb_dataatend);
					$sm->setDataCancel($row->smb_datacancel);
					$sm->setAutorizadoPor($row->smb_autorizadopor);
					$sm->setDataAutoriz($row->smb_dataautoriz);
					$sm->setAutorizante($row->smb_autorizante);
					$sm->setLocal($row->smb_local);
					$sm->setAutorizadaEm($row->smb_autorizadaem);
					$sm->setEmpresa($row->smb_empresa);
					$sm->setLiberada($row->smb_liberada);
					
					array_push($list, $sm);
					
				}
				
				return $list;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	public function updateLocalizacaoSM($sm, $loc) {
		try {
		
			$stmt = $this->openConnection();
			
			$sql = 'UPDATE sma_solicitacaomaterial SET sma_local = ? WHERE sma_codigo = ?';
		
			$rs = $stmt->prepare($sql);
									
									

			
			$rs->bindParam(1,$loc, PDO::PARAM_INT);
			$rs->bindParam(2,$sm, PDO::PARAM_INT);
			
			$stmt->beginTransaction();
			
			$rs->execute();
			
			
            if($rs->rowCount() > 0){
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }
		
		} catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}

	public function updateQtdeSM($sm, $item, $qtde) {
		try {
		
			$stmt = $this->openConnection();
			
			$sql = 'UPDATE smi_smaitem SET smi_quantidade = ?, smi_compra = ? 
					WHERE smi_solicitacaomaterial = ? AND smi_item = ? AND smi_compra > 0 ';
		
			$rs = $stmt->prepare($sql);
			
			$rs->bindParam(1,$qtde, PDO::PARAM_INT);
			$rs->bindParam(2,$qtde, PDO::PARAM_INT);
			$rs->bindParam(3,$sm, PDO::PARAM_INT);
			$rs->bindParam(4,$item, PDO::PARAM_INT);
			
			$stmt->beginTransaction();
			
			$rs->execute();
			
            if($rs->rowCount() > 0){
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }
		
		} catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}
	
	
	public function updateAtendimentoSM($sm) {
		try {
		
			$stmt = $this->openConnection();
			
			$sql = 'UPDATE sma_solicitacaomaterial SET sma_atendida = 0 WHERE sma_codigo = ? ';
		
			$rs = $stmt->prepare($sql);
			
			$rs->bindParam(1,$sm, PDO::PARAM_INT);
			
			$stmt->beginTransaction();
			
			$rs->execute();
			
			
			
            if($rs->rowCount() > 0){
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }
		
		} catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}
	
	public function updateRevokeAutorizacao($sm) {
		try {
		
			$stmt = $this->openConnection();
			
			$sql = 'UPDATE sma_solicitacaomaterial 
						SET sma_autorizada = 0, sma_autorizadopor = NULL, sma_dataautoriz = NULL, sma_autorizante = NULL, sma_liberada = 0  
						WHERE sma_codigo = ? AND sma_atendida = 0';
		
			$rs = $stmt->prepare($sql);
			
			$rs->bindParam(1,$sm, PDO::PARAM_INT);
			
			$stmt->beginTransaction();
			
			$rs->execute();
			
			
			
            if($rs->rowCount() > 0){
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }
		
		} catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}

}

?>
