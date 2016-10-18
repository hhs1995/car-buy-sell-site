<?php
			$title = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$pagename.'-title'));
			
			if ($title['Textosdinamico']['valor']=='')
			{
			$pagename = 'default';
			$title = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$pagename.'-title'));
			}  
			
			
   	if (isset($idmarca))
			{
						$search = $pagename.'-pormarca-metadescription';
			}
			else 
			{
						$search = $pagename.'-metadescription';
			}
			
			
			$description = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$search));
			if ($description['Textosdinamico']['valor']=='')
			{
			$pagename = 'default';
			$search = $pagename.'-metadescription';
			$description = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$search));
			}   



			$keywords = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$pagename.'-metakeywords'));
			if ($keywords['Textosdinamico']['valor']=='')
			{
			$pagename = 'default';
			$keywords = $this->requestAction(array('controller'=>'Textosdinamicos','action'=>'get',$pagename.'-metakeywords'));
			}  


			if (isset($idmarca))
			{
						$finaltitle = $title['Textosdinamico']['valor'].' - '.$marcas[$idmarca];
						$finaldescription = str_replace('%marca%',$marcas[$idmarca],$description['Textosdinamico']['valor']);
						$finalkeywords = $keywords['Textosdinamico']['valor'].', '.$marcas[$idmarca];
			}
			else if (isset($plantags))
			{
						$finaltitle = str_replace('%name%',$nombre,$title['Textosdinamico']['valor']);
						if ($mdescription!=''){$finaldescription = $mdescription;}
						else{$finaldescription = $description['Textosdinamico']['valor'];}
						$finalkeywords = $keywords['Textosdinamico']['valor'].', '.$plantags;
			}
			else 
			{
						$finaltitle = $title['Textosdinamico']['valor'];
						$finaldescription = $description['Textosdinamico']['valor'];
						$finalkeywords = $keywords['Textosdinamico']['valor'];
			}
			
			if (isset($nombre))
			{
				$finaltitle= str_replace('%name%',$nombre,$finaltitle);
				$finaldescription = str_replace('%name%',$nombre,$finaldescription);
				$finalkeywords = str_replace('%name%',$nombre,$finalkeywords);
			}
			
			if (isset($idmarca))
			{
				$finaltitle= str_replace('%marca%',$marcas[$idmarca],$finaltitle);
				$finaldescription = str_replace('%marca%',$marcas[$idmarca],$finaldescription);
				$finalkeywords = str_replace('%marca%',$marcas[$idmarca],$finalkeywords);
			}
			
			$this->set('title_for_layout', $finaltitle);
			$this->Html->meta('description', (!empty($finaldescription) ? $finaldescription : ''), array('inline' => false));
			$this->Html->meta('keywords', (!empty($finalkeywords) ? $finalkeywords : ''), array('inline' => false));			
			
			
?>