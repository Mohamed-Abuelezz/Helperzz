<style>

    /******************* Footer Section */

footer{
    background-color: var(--primary);
  
  }
  .footer {
  
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height:40vh;
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
    bottom: 50px; 
    right: 30px; 
    z-index: 99; 
    border: none; 
    outline: none; 
    background-color: var(--buttons);
    color: var(--primary);
    cursor: pointer; 
    padding: 15px;
    border-radius: 15px;
    font-size: 18px;
  }
  
  #top:hover {
    background-color: var(--primary);
    color: white;
    box-shadow: 5px 5px 10px;
  }
  
  
  
</style>




<footer>
    <div class="footer container-lg">

        <ul>
          <li> <a href="{{route('terms')}}"> {{Config::get('app.locale') == 'ar' ?  'الشروط والاحكام' :  'Terms And Conditions'}}</a></li>
          <li> <a href="{{route('contactUs')}}"> {{Config::get('app.locale') == 'ar' ?  'تواصل معنا' :  'Contact Us'}}</a></li>
  </ul>


        <img src="{{asset('Website_Assets/assets/images/footer.png')}}" />


    </div>

</footer>


<button onclick="topFunction()" id="top" title="Go to top"> {{Config::get('app.locale') == 'ar' ? 'اعلي' : 'Top' }}</button>
