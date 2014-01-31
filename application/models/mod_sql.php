<?php
	class mod_sql extends CI_Model {

		

        function sql_scanoverzicht($go, $zoekw) {
            
                 if ($go==0) { $sqlgo="or Status>=1";} 
            else if ($go==1) { $sqlgo="or Status<=2";} 
            else if ($go>=3) { $sqlgo="or Status=".$go;} 
            else { $sqlgo=""; }
                        
           if(isset($zoekw)) {
                $query = $this->db->query("SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID WHERE DataCUploads.Achternaam like '%".$zoekw."%' and ( UserID<1 $sqlgo )  ORDER BY DataCUploads.UID DESC ");       
                      
                } else {
                $query = $this->db->query("SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID WHERE UserID<1 $sqlgo  ORDER BY DataCUploads.UID DESC LIMIT 100");
                                
                }

           return $query->result();
           }


          

          function sql_gebruikersoverzicht($zoekw) {
           
          if(isset($zoekw)) { 
                 $query = $this->db->query("SELECT * FROM `DataCgebruikers` WHERE Bedrijfsnaam like '%".$zoekw."%'");
                 } else {
                 $query = $this->db->query('SELECT * FROM DataCgebruikers WHERE UID>=1 ORDER BY UID DESC ');
                 } 
           return $query->result(); 
          }

    

          function sql_homeoverzicht() {
             $query = $this->db->query('SELECT *,DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID ORDER BY DataCUploads.UID DESC LIMIT 15 ');
             return $query; 
          }
        

        

        function sql_qrygegevens($id) {
             $qrygegevens = $this->db->query('SELECT * FROM `DataCgebruikers` LEFT OUTER JOIN DataCGebruikersNaw ON DataCgebruikers.UID=DataCGebruikersNaw.GebruikersID WHERE DataCgebruikers.UID ='.$id );
             return $qrygegevens;
           }
        
        function sql_qrylogging($id) {
             $qrylogging = $this->db->query('SELECT * FROM `DataCLogging` WHERE GebruikersID ='.$id.' order by UID ASC');
             return $qrylogging; 
           }
      
        
        function sql_qryopmerkingen($id) {
            $qryopmerkingen = $this->db->query('SELECT * FROM `DataCOpmerkingen` WHERE GebruikersID ='.$id.' order by UID DESC');
             return $qryopmerkingen;
           }
        
        function sql_qrylaatstescans($id) {
            $qrylaatstescans = $this->db->query('SELECT * FROM DataCUploads WHERE UserID ='.$id.' ORDER BY UID DESC' );
             return $qrylaatstescans; 
 
          }


          function sql_qryjaarrapportnvm() {
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportnvm=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = 2013 AND DataCgebruikers.Type_check='NVM' ");
            foreach ($qryjaarrapportnvm->result() as $row) {$JRm=$row->totaal;}
            $aJRm.=$JRm.",";
            }
            return  $aJRm; 
          }
          function sql_qryjaarrapportbwt() {
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportbwt=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = 2013 AND DataCgebruikers.Type_check='BWT' ");
            foreach ($qryjaarrapportbwt->result() as $row) {$JRb=$row->totaal;}
            $aJRb.=$JRb.",";
            }
            return  $aJRb; 
          }
          function sql_qryjaarrapportppc() {
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportppc=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = 2013 AND DataCgebruikers.Type_check='PPC' ");
            foreach ($qryjaarrapportppc->result() as $row) {$JRp=$row->totaal;}
            $aJRp.=$JRp.",";
            }
            return  $aJRp; 
          }


           
          //JAAR

          function sql_qrytotaaljaar($kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            $qrytotaaljaar = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' $sqlkn ");
          return  $qrytotaaljaar; 
          }

          function sql_qryjaargoed($kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            $qryjaargoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (1,2) $sqlkn");
          return  $qryjaargoed; 
          }

          function sql_qryjaarfout($kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            $qryjaarfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (3) $sqlkn");
          return  $qryjaarfout; 
          }

          function sql_qryjaarreje($kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            $qryjaarreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (999) $sqlkn");
          return  $qryjaarreje; 
          }

          //DAG
          function sql_qrytotaaldag() {
            $qrytotaaldag   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' ORDER BY UID ASC");
          return  $qrytotaaldag; 
          }
          
          function sql_qrydaggoed() {
             $qrydaggoed     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (1,2)  ORDER BY UID ASC");
          return  $qrydaggoed; 
          }
          
          function sql_qrydagfout() {
             $qrydagfout     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (3)  ORDER BY UID ASC");
          return  $qrydagfout; 
          }

          function sql_qrydagreje() {
             $qrydagreje     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (999)  ORDER BY UID ASC");
          return  $qrydagreje; 
          }

          

          //klanten ophalen
          function sql_qryklanten() {
          $qryklanten = $this->db->query("SELECT UID, Bedrijfsnaam FROM  `DataCgebruikers` ORDER BY Bedrijfsnaam ASC ");
          return  $qryklanten; 
          }

          //NVM, BWT of PPC
          function sql_qrynvm($tr, $jr) {
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            $qrynvm = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'NVM'  ");
          return  $qrynvm; 
          }
          function sql_qrybwt($tr, $jr) {
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            $qrybwt = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'BWT'  ");
          return  $qrybwt; 
          }
          function sql_qryppc($tr, $jr) {
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            $qryppc = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'PPC'  ");
          return  $qryppc; 
          }
          function sql_qrynvb($tr, $jr) {
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            $qrynvb = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'NVMB'  ");
          return  $qrynvb; 
          }

          

          //VARIABEL inlusief NVM + BWT + PPC
          function sql_qryvariabeltotaal($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

            $qrytotaalvariabel=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlbr ");
            return  $qrytotaalvariabel; 
          }
        
          function sql_qryvariabelgoed($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

            $qryvariabelgoed = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlbr  ");
            return  $qryvariabelgoed; 
        
          }
          function sql_qryvariabelfout($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

           $qryvariabelfout = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3)  $sqlbr  ");
            return  $qryvariabelfout; 
        
          }
          function sql_qryvariabelreje($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

           $qryvariabelreje = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999)  $sqlbr  ");
            return  $qryvariabelreje; 
        
          }
          function sql_qryvariabelbeha($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

           $qryvariabelbeha = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlbr  ");
             return  $qryvariabelbeha; 
        
          }

          //VARIABEL 
          function sql_qryvariabeltotaalV($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
            $qrytotaalvariabel = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlkn ");
            return  $qrytotaalvariabel; 
          }
          function sql_qryvariabelgoedV($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
            $qryvariabelgoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlkn ORDER BY UID ASC");
            return  $qryvariabelgoed; 
          }
          function sql_qryvariabelfoutV($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
            $qryvariabelfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3) $sqlkn ORDER BY UID ASC");
            return  $qryvariabelfout; 
          }
          function sql_qryvariabelrejeV($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
           $qryvariabelreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999) $sqlkn ORDER BY UID ASC");
           return  $qryvariabelreje; 
          }
          function sql_qryvariabelbehaV($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
           $qryvariabelbeha   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlkn ORDER BY UID ASC");
           return  $qryvariabelbeha; 
          }



  }
   
       
?>
