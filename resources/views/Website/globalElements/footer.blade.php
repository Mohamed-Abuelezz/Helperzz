<style>

    /******************* Footer Section */
.fa-facebook-square{
  font-family: "Font Awesome 5 Brands"  !important;
  color: white
}
footer{
    background-color: var(--primary);
  
  }
  .footer {
  
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height:35vh;
  }
  footer ul{
    list-style-type: none;
    display: flex;
    flex-direction: column;
    align-self: center;
    
  }
  
  footer ul li{
    padding: 0px 10px;
  margin-top: 20px;  
    }
    
    
    footer a{
    text-decoration: none;
    height: auto;
    color: rgba(255, 255, 255,.7);
    }
    
    footer a:hover{
      text-decoration: none;
      color: rgba(255, 255, 255,1);
    transition: 1s all;
    font-size: 18px;
    cursor: pointer;
    }
    
  
    @media (max-width: 991.98px) { 
      footer a{
        text-decoration: none;
        height: auto;
        color: rgba(255, 255, 255,.7);
        font-size: 15px;
        }
        footer img{
          width: 40%;
          height: 100%;
        }
        .footer{
          margin: 0;
          padding: 0;
          width: 100%; 
        }
    }
  /******************* End Footer Section */
  
  
  
  #top {
    display: none; 
    position: fixed; 
    bottom: 20px; 
    left: 30px; 
    right: unset;
    z-index: 99; 
    border: none; 
    outline: none; 
    background-color: var(--primary);
    color: white;
    cursor: pointer; 
    padding: 15px;
    border-radius: 15px;
    font-size: 18px;
  }
  
  #top:hover {
    cursor: pointer;
  box-shadow: 0 .5rem 1rem rgba(0,0,0, .40);
  transition: box-shadow 1s;
  }
  
  
  
</style>




<footer>
    <div class="footer container-lg">

        <ul>
          <li> <a href="{{route('terms')}}"> {{Config::get('app.locale') == 'ar' ?  'الشروط والاحكام' :  'Terms And Conditions'}}</a></li>
          <li> <a href="{{route('contactUs')}}"> {{Config::get('app.locale') == 'ar' ?  'تواصل معنا' :  'Contact Us'}}</a></li>
          <hr style="margin: 5px">
          <li style="margin: 0px">   
           <a href="https://www.facebook.com/Helperzz2022" target="_blank" style="color: whitesmoke;font-size: 30px;text-decoration: none">
            <i class="fab fa-facebook-square"></i>            
          </a>
          
          <a href="mailto:contact@helperzz.com" target="_blank" style="color: whitesmoke;font-size:30px;text-decoration: none">
            <i class="fas fa-envelope"></i>
                    </a>      
          </li>
  </ul>


        <img src="{{asset('Website_Assets/assets/images/footer.png')}}" alt="footer image" />


    </div>

</footer>


<button onclick="topFunction()" id="top" title="Go to top"> {{Config::get('app.locale') == 'ar' ? 'اعلي' : 'Top' }}</button>
