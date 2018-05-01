<?php

class EGMapAutocomplete extends EGMapBase
{
  //String $url url of image
  protected $inputId;
  protected $marker_object = 'google.maps.places.Autocomplete';  
  
  const GMAP_LIBRARY = 'http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false';
   
  public function __construct( $inputId = 'searchTextField',$js_name = 'autocomplete')
  {
    $this->inputId = $inputId;
    $this->setJsName($js_name);    
  }
  
  /**
   * 
   * @return inputId
   */
  public function getInputId()
  {
    return $this->inputId;
  }

  /**
   * 
   * @return string js code to create the autoComplete
   */
	public function toJs($map_js_name = 'map')
	{
		$this->options['map'] = $map_js_name;
    $return = "var input = document.getElementById('".EGMap::encode($this->inputId)."');". PHP_EOL;
		$return .= $this->getJsName() . ' = new ' . $this->marker_object . '(input);' . PHP_EOL;
    $return .= $this->getJsName().".bindTo('bounds', ".$map_js_name.");" . PHP_EOL;

    $event = new EGMapEvent('place_changed', "function(event) {
          ".$map_js_name."_info_window.close();
          var place = ".$this->getJsName().".getPlace();
              console.log(place);
          if (place.geometry.viewport) {
            ".$map_js_name.".fitBounds(place.geometry.viewport);
          } else {
            ".$map_js_name.".setCenter(place.geometry.location);
            ".$map_js_name.".setZoom(17);  
          }
          ".$map_js_name."_marker.setPosition(place.geometry.location);
          
          var address = '';
          if (place.address_components) {
            address = [(place.address_components[0] &&
                        place.address_components[0].short_name || ''),
                       (place.address_components[1] &&
                        place.address_components[1].short_name || ''),
                       (place.address_components[2] &&
                        place.address_components[2].short_name || '')
                      ].join(' ');
          }

          ".$map_js_name."_info_window.setContent('<div><strong>' + place.name + '</strong><br />' + address);
          ".$map_js_name."_info_window.open(".$map_js_name.", ".$map_js_name."_marker);
              
        /**edited by Ukpro**/
        $('#h_lng').val(place.geometry.location.lng());
        $('#h_lat').val(place.geometry.location.lat());
        /** end edited by Ukpro **/
        
      }",false);    

    $return .= $event->getEventJs($this->getJsName()) . PHP_EOL;
    
		return $return;
	}

}
