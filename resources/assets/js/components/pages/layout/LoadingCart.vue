<template>
    <div class="loader-bg">
      <ul class="loader">
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
</template>


<style type="text/css" lang="scss" scoped>
  body {
  margin: 0;
  padding: 0;
}
.loader-bg {
  width: 100%;
  height: 100vh;
  z-index: 1000;
  left: 0;
  top:0;
  bottom: 0;
  right: 0;
  position: absolute;
  background-color: #ffffffc7;
}

.loader {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  margin: 0;
  padding: 0;
  display: flex; 
}
.loader li {
    width: 10px;
    height: 10px;
    background-color: #eb622d;
    border-radius: 20px;
    margin: 0.5rem;
    animation: animate 1.4s linear infinite; 
}

@keyframes animate {
  0% { transform: translateY(0); }
  20% { transform: translateY(10px); }
  40% { transform: translateY(30px); }
  60% { transform: translateY(10px); }
  80% { transform: translateY(30px); }
  100% { transform: translateY(0) }
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

ul li:nth-child(1) { animation-delay: 0s; }
ul li:nth-child(2) { animation-delay: -1.2s; }
ul li:nth-child(3) { animation-delay: -1s; }
ul li:nth-child(4) { animation-delay: -.8s; }
ul li:nth-child(5) { animation-delay: -6s; }
</style>