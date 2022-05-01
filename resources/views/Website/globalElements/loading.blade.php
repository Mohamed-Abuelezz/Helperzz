<style>
  .progress {
  background: rgba(255,255,255,0.1);
  display: flex;
  justify-content: center;
  border-radius: 100px;
  align-items: center;
  margin: 0px auto;
  padding: 0 5px;
  height: 40px;
  width: 300px;
}

.progress-value {
  animation: load 2s normal forwards;
  box-shadow: 0 5px 5px -10px var(--buttons);
  border-radius: 100px;
  background:white;
  height: 10px;
  width: 0;
}

@keyframes load {
  0% { width: 0; }
  100% { width: 100%; }
}
</style>


<div class="bg_load ">
    <img src="{{ asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" class="animate__animated animate__flipInX" width="200" alt="">
 
    <div class="progress">
      <div class="progress-value"></div>
    </div>
  </div>
