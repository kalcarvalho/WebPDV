<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author kalcarvalho
 */
interface IDatabaseFinder {
    public function findByPK($pk);
    public function listAll();
}
?>
