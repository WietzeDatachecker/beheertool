<?php
	class mod_sql extends CI_Model {

		    // query scan overzicht

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


          // query gebruikers overzicht

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
        

        
          //query gebruikers
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

        // Query rapport:  jaar overzicht 
          function sql_qryjaarrapportnvm($jr) {
            
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportnvm=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check='NVM' ");
            foreach ($qryjaarrapportnvm->result() as $row) {$JRm=$row->totaal;}
            $aJRm.=$JRm.",";
            }
            return  $aJRm; 
          }
          function sql_qryjaarrapportbwt($jr) {
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportbwt=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check='BWT' ");
            foreach ($qryjaarrapportbwt->result() as $row) {$JRb=$row->totaal;}
            $aJRb.=$JRb.",";
            }
            return  $aJRb; 
          }
          function sql_qryjaarrapportppc($jr) {
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            
            for($md=1; $md<=12; $md++) {
            $qryjaarrapportppc=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) =$md AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check='PPC' ");
            foreach ($qryjaarrapportppc->result() as $row) {$JRp=$row->totaal;}
            $aJRp.=$JRp.",";
            }
            return  $aJRp; 
          }

         
           
          

          // TEST rapport: JAAR
          function sql_jaar($kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            
          $qrytotaaljaar = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' $sqlkn ");
          $qryjaargoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (1,2) $sqlkn");
          $qryjaarfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (3) $sqlkn");
          $qryjaarreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (999) $sqlkn");
         

          $jaar = array();
          
          foreach ($qrytotaaljaar->result() as $row)    {  $jaar[totaal] = $row->totaal;   }                        
          foreach ($qryjaargoed ->result() as $row)     {  $jaar[goed]   = $row->totaal;   } 
          foreach ($qryjaarfout ->result() as $row)     {  $jaar[fout]   = $row->totaal;   } 
          foreach ($qryjaarreje ->result() as $row)     {  $jaar[reje]   = $row->totaal;   }                
          
          return $jaar;
          }
          


         
          //query rapport: DAG
          function sql_dag() {
            $qrytotaaldag   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' ORDER BY UID ASC");
            $qrydaggoed     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (1,2)  ORDER BY UID ASC");
            $qrydagfout     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (3)  ORDER BY UID ASC");
            $qrydagreje     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (999)  ORDER BY UID ASC");
          
          $dag = array();

            foreach ($qrytotaaldag->result() as $row)    {  $dag[totaal] = $row->totaal;   }
            foreach ($qrydaggoed->result() as $row)      {  $dag[goed] = $row->totaal;   }
            foreach ($qrydagfout->result() as $row)      {  $dag[fout] = $row->totaal;   }
            foreach ($qrydagreje->result() as $row)      {  $dag[reje] = $row->totaal;   }

          return  $dag; 
          

          }

                   

          // query rapport: klanten ophalen
          function sql_qryklanten() {
          $qryklanten = $this->db->query("SELECT UID, Bedrijfsnaam FROM  `DataCgebruikers` ORDER BY Bedrijfsnaam ASC ");
          return  $qryklanten; 
          }

         

          


          //query rapport: VARIABEL inlusief NVM + BWT + PPC
          function sql_varinbp($tr, $jr, $kn, $br) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
            if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }

            $qrytotaalvariabel=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlbr ");
            $qryvariabelgoed = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlbr  ");
            $qryvariabelfout = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3)  $sqlbr  ");
            $qryvariabelreje = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999)  $sqlbr  ");
            $qryvariabelbeha = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlbr  ");
           
           $varinbp = array();

            foreach ($qrytotaalvariabel->result() as $row)    {  $varinbp[totaal] = $row->totaal;   }
            foreach ($qryvariabelgoed->result() as $row)      {  $varinbp[goed] = $row->totaal;   }
            foreach ($qryvariabelfout->result() as $row)      {  $varinbp[fout] = $row->totaal;   }
            foreach ($qryvariabelreje->result() as $row)      {  $varinbp[reje] = $row->totaal;   }
            foreach ($qryvariabelbeha->result() as $row)      {  $varinbp[beha] = $row->totaal;   }

            return  $varinbp; 
           
          }
          
            // query rapport: VARIABEL 
          function sql_vari($tr, $jr, $kn) {
            if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }
            if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }
            if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }
           
            $qrytotaalvariabel = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlkn ");
            $qryvariabelgoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlkn ORDER BY UID ASC");
            $qryvariabelfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3) $sqlkn ORDER BY UID ASC");
            $qryvariabelreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999) $sqlkn ORDER BY UID ASC");
            $qryvariabelbeha   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlkn ORDER BY UID ASC");
           
          $vari = array();

            foreach ($qrytotaalvariabel->result() as $row)    {  $vari[totaal] = $row->totaal;   }
            foreach ($qryvariabelgoed->result() as $row)      {  $vari[goed] = $row->totaal;   }
            foreach ($qryvariabelfout->result() as $row)      {  $vari[fout] = $row->totaal;   }
            foreach ($qryvariabelreje->result() as $row)      {  $vari[reje] = $row->totaal;   }
            foreach ($qryvariabelbeha->result() as $row)      {  $vari[beha] = $row->totaal;   }


            return  $vari; 
          }





        


  }
   
       
?>
