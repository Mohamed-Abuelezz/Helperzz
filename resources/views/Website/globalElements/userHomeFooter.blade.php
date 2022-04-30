<style>
      
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

        <p>
            All Copyright {{ \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name}} 2022
        </p>


        <img src="{{asset('Website_Assets/assets/images/footer.png')}}" />


    </div>

</footer>


<button onclick="topFunction()" id="top" title="Go to top">Top</button>
