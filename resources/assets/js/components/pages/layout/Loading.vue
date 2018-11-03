<template>
	<div class="loading-bro">
	  <svg id="load" x="0px" y="0px" viewBox="0 0 150 150">
	    <circle id="loading-inner" cx="75" cy="75" r="60"/>
	 </svg>
	</div>
</template>
<style type="text/css" lang="scss" scoped>
	@import url(https://fonts.googleapis.com/css?family=Roboto:400,300);


.loading-bro {
  position: fixed;
  width: 100%;
  height: 100%;
  background: white;
  top:0;
  bottom: 0;
  z-index: 99;
  > h1 {
    text-align: center;
    font-size: 2.5em;
    margin-bottom: 1em;
    font-weight: 300;
    color: #8E8E8E;
  }
}

#load {
		width: 50px;
		margin: 300px 600px; 
    animation: loading 3s linear infinite;
    #loading-inner {
		  stroke: {
        dashoffset: 0;
        dasharray: 300;
        width: 10;
        miterlimit: 10;
        linecap: round;
      }
      animation: loading-circle 2s linear infinite;
      stroke: #686a6d;
      fill: transparent;
    }
	}

@keyframes loading {
		0% { 
      transform: rotate(0); 
    }
		100% { 
      transform: rotate(360deg);
    }
}
@keyframes loading-circle {
		0% { 
      stroke-dashoffset: 0
    }
		100% { 
      stroke-dashoffset: -600;
    }
}
</style>

<style type="text/css"></style>