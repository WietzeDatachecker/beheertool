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

	}

   

?>