<?php

include_once '../domain/NotaFiscal.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class NotaFiscalDAO extends DAO implements IDatabaseFinder {


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

				$sm = new NotaFiscal();
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

				$sm = new NotaFiscal();
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
	
    public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT ntf_notafiscal.*
                                 FROM ntf_notafiscal 
								 ORDER BY ntf_codigo DESC ");
            
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
	
	public function listAllNFes($date, $qtype, $query, $sort, $limit, &$total=NULL) {
		try {
            
            $stmt = $this->openConnection();
			
			$sql = "SELECT ntf_notafiscal.*, des_nomerazao FROM ntf_notafiscal ";
			$sql .= "LEFT OUTER JOIN des_destinatario ON des_codigo = ntf_destinatario ";
			
			if( $qtype == '' || $query == '' ) {
			
				
				$sql .= "WHERE DATE_FORMAT(ntf_emissao, '%Y-%m-%d') >= ? 
						AND ntf_empresa = 1 AND ntf_modelo = 1 
						  ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
				
				$rs = $stmt->prepare($sql); 
									 
				$rs->bindParam(1, $date, PDO::PARAM_STR);
				
				
			} else {
			
				$sql .= "WHERE DATE_FORMAT(ntf_emissao, '%Y-%m-%d') >= ? 
						 AND ntf_empresa = 1 AND ntf_modelo = 1 AND $qtype=$query
						 ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
							
				$rs = $stmt->prepare($sql); 
			
				$rs->bindParam(1, $date, PDO::PARAM_STR);
			
			}
			
			// $xFile = '../temp/sql.ini';
			// ($fp = fopen($xFile, 'w')) or exit(0); 
			// fwrite($fp, $sql);
			// fclose($fp);

								 
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
					
					$nfe = new NotaFiscal();
					$nfe->setCodigo($row->ntf_codigo);
					$nfe->setNumero($row->ntf_numero);
					$nfe->setEmissao($row->ntf_emissao);
					$nfe->setTipo($row->ntf_tiponota);
					$nfe->setDestinatario($row->des_nomerazao);
					$nfe->setTotal($row->ntf_total);
					$nfe->setCancelada($row->ntf_cancelada);
					$nfe->setProtocolo($row->ntf_protocolo);
					
					array_push($list, $nfe);
					
				}
				
				return $list;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	
	
	public function updateCFOPNFe($nfe, $origem, $destino, $ref) {
		try {
		
			$stmt = $this->openConnection();
			
			$sql = "UPDATE nfi_nfitem SET nfi_cfop = ?, nfi_cfop_ref = ? ";
			$sql .= "WHERE nfi_notafiscal = ? AND nfi_cfop = ? ";
		
			$rs = $stmt->prepare($sql);
									
			
			$rs->bindParam(1,$destino, PDO::PARAM_INT);
			$rs->bindParam(2,$ref, PDO::PARAM_STR);
			$rs->bindParam(3,$nfe, PDO::PARAM_INT);
			$rs->bindParam(4,$origem, PDO::PARAM_INT);
			
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
