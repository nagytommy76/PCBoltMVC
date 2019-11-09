<?php
class Search{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function selectAllTest($category){
        $this->db->query('SELECT * FROM '.$category);
        $result = $this->db->resultSet();

        return $result;
    }
    public function searchResult($input,$man,$cat){
        switch ($cat) {
            case 'cpu':
                $manufact = ($man === "" ? '' : 'AND cpufoglalatok.gyarto LIKE "'.$man.'"');
                $this->db->query(
                    'SELECT tipus, fogyasztas, kepurl, orajel, turbo_orajel, cpufoglalatok.foglalat, cpufoglalatok.gyarto, cpuarak1.ar
                    FROM cpu
                    LEFT JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
                    LEFT JOIN cpufoglalatok ON cpu.foglalatid = cpufoglalatok.foglalatID
                    WHERE tipus LIKE "%'.$input.'%" '.$manufact.'
                    '
                );
                if (empty($this->db->resultSet())) {
                    return $result = array('tipus' => 'Not Found', );
                }else{
                    $result = $this->db->resultSet();
                    return $result;
                }
                break;
            case 'motherboard':
                $manufact = ($man === "" ? '' : 'AND motherboard.gyarto LIKE "'.$man.'"');
                $this->db->query(
                    'SELECT cikkszam, motherboard.gyarto, MBtipus, chipset, picUrl, mbprices.price, cpufoglalatok.foglalat
                    FROM motherboard
                    LEFT JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam
                    LEFT JOIN cpufoglalatok ON motherboard.cpufoglalatID = cpufoglalatok.foglalatID
                    WHERE MBtipus LIKE "%'.$input.'%"'.$manufact.''
                );
                if (empty($this->db->resultSet())) {
                    return $result = array('MBtipus' => 'Not Found');
                }else{
                    $result = $this->db->resultSet();
                    foreach ($result as $res) {
                        pictureSplitting($res,';');
                    }
                    return $result;
                }
                break;
            // default:
                
            //     break;
        }
        
    }
}

