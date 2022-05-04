<style>
      
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

        <p>
            All Copyright Reserved  2022
        </p>


        <img src="{{asset('Website_Assets/assets/images/footer.png')}}" />


    </div>

</footer>


<button onclick="topFunction()" id="top" title="Go to top"> {{Config::get('app.locale') == 'ar' ? 'اعلي' : 'Top' }}</button>
