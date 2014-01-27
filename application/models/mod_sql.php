<?php
	class mod_sql extends CI_Model {

		function sql_scanoverzicht() {

			


           echo 'test pagina'; 
           $query = $this->db->query("SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID WHERE UserID<1   ORDER BY DataCUploads.UID DESC LIMIT 100");
                                                
          
          
    }

	}

?>