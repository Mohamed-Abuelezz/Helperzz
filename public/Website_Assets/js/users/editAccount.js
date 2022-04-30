$(document).ready(function() {


      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    
    });


    



  // Google Maps

  // Google Maps

    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        const uluru = { lat: -25.344, lng: 131.036 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: uluru,
        });
  
        const your_img_url = "https://cdn.psychologytoday.com/sites/default/files/styles/article-inline-half-caption/public/field_blog_entry_images/2018-09/shutterstock_648907024.jpg?itok=0hb44OrI";
        var icon = {
            url: your_img_url + '#custom_marker', // url + image selector for css
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        var styles =[
          {
            "stylers": [
              { "hue": "#009DAE" },
              { "saturation": 0 },
              { "lightness": 0 }
            ]
          }
        ];
        //    map.setOptions({styles: myStyle});
            map.setOptions({styles: styles});
  
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
          icon: icon,
  
        });
  
        const contentString =
        `    <div class="winInfo">
        <img src="https://cdn.psychologytoday.com/sites/default/files/styles/article-inline-half-caption/public/field_blog_entry_images/2018-09/shutterstock_648907024.jpg?itok=0hb44OrI" alt="">
      
      <div class="main">
        <h3>medo ezz</h3>
  
        <div class="rate">
            😍 3.5
        </div>
      </div>
  
        <div class="info">
            <p>فني صيانة</p>
            <p>مصر/المحلة الكبري</p>
        </div>
    
    
    </div>`;
      const infowindow = new google.maps.InfoWindow({
        content: contentString,
      });
  
        marker.addListener("click", () => {
          infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
          });
  
  
  
  
          
  
        });
      
  
  
  
  
  
        
      }




    