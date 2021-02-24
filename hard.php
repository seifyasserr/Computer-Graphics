<html>
<!-- My scene -->
<canvas id="scene" onclick="mouseFunction(event)"></canvas>

<script src="lib/three.min.js"></script>
<script src="lib/OrbitControls.js"></script> 

<script>

//Get the height and the width of the window
var ww = window.innerWidth,
  wh = window.innerHeight;
  var cw=300, //width
    cl=300, //length
    ch=50;  //height
     var  moveRight = true;
    var stackHeight=50;
    var cubeCounter=0;
    var sphereCounter=0;
   var left=true;
    var step =0;
    var score=0;
    var color=new THREE.Color(parseInt(Math.random()*16777216));
function init(){

  /* WEBGL RENDERER */

  //Create the webGl renderer from Three
  renderer = new THREE.WebGLRenderer({canvas : document.getElementById('scene')});
  //Set the background of our scene
  renderer.setClearColor(0x000000);
  //Set the size of my renderer, I want it to be fullscreen
  renderer.setSize(ww,wh);


  /* SCENE */

  //Create my scene
  scene = new THREE.Scene();
  loader = new THREE.TextureLoader();
    bgTexture = loader.load('c22e4b59d987b2d7dac0218f14c22373.jpg');
    scene.background = bgTexture;

  /* CAMERA */

  //Create a new Perspective Camera with four parameters
  
  camera = new THREE.PerspectiveCamera(100, ww/wh, 0.1, 10000 );
  //We set our camera at x:0,y:0 and z:500
  camera.position.set(0, -500, 400);
  //And finally we add our camera in our scene
  scene.add(camera);


    control = new THREE.OrbitControls( camera );
  

  //Create all shapes in the scene
  createShape();
    createNewShape();
    manySpheres();
  var light = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(light);

  
  //This is very important, it will ask the renderer to render our scene
  renderer.render(scene,camera);


  //call all the animation functions here
    translateCube();
    animateShperes();
  
};

function makeInstance(geometry,color, x,z) {
    material = new THREE.MeshPhongMaterial({color:color});

     cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    cube.position.x = x;
  cube.position.z+=z;
    return cube;
  }
  function makeInstance1(geometry,color, x,z) {
    material = new THREE.MeshPhongMaterial({color:color});

     cube1 = new THREE.Mesh(geometry, material);
    scene.add(cube1);

    cube1.position.x = x;
  cube1.position.z+=z;
    return cube1;
  }

function createShape(){
  geometryBox = new THREE.BoxGeometry(cw,cl,ch);
  makeInstance(geometryBox,color,0,0);
  

};

function createNewShape(){
    color=new THREE.Color(parseInt(Math.random()*16777216));

  geometryBox = new THREE.BoxGeometry(cw,cl,ch);
  makeInstance1(geometryBox,color,700,stackHeight)
  
  renderer.render(scene,camera);
};
function translateCube (){
    
    
          //Request another frame of the animation
          requestAnimationFrame(translateCube);
          
         if(left)
         {
          if(cubeCounter<50)
          {
      
          cube1.translateX(-26);
          
          renderer.render(scene, camera);
         
          cubeCounter++;
      
          }
          else
          {
              left=false;
          }
         }
         if(!left)
         {
             if(cubeCounter!=0)
          {
             
          cube1.translateX(26);
          
          renderer.render(scene, camera);
         
          cubeCounter--;
     
          }
          else{left=true;}
         }
      
     
      };

      function mouseFunction(e){

        
        
      if(cube1.position.x>cube.position.x-cw&&cube1.position.x<cube.position.x+cw)
  {
        camera.position.z+=30;
        cubeCounter=0;
      
    console.log(cube.position.x-cw);
    console.log(cube.position.x+cw);
    console.log(cube1.position.x);
    
    if(cube1.position.x<0)
    {
      cw+=cube1.position.x;
    
  geometryBox = new THREE.BoxGeometry(cw,cl,ch);
  makeInstance(geometryBox,color,cube.position.x,stackHeight)
    }
    else if(cube1.position.x>0)
    {
      cw-=cube1.position.x;
    
  geometryBox = new THREE.BoxGeometry(cw,cl,ch);
  makeInstance(geometryBox,color,cube.position.x,stackHeight)
        }
        else
        {
           
            makeInstance(geometryBox,color,cube.position.x,stackHeight)
            score+=cw;
            document.getElementById('score').innerHTML=score;
        }
        
        color=new THREE.Color(parseInt(Math.random()*16777216));
        scene.remove(cube1);
        stackHeight+=ch;
        makeInstance1(geometryBox,color,700,stackHeight);
        score+=cw;
       document.getElementById('score').innerHTML=score;
    }
    else
        {
            camera.position.z-=1;
        }
    
      };
     

init();
</script>
<div id="score" style="position:absolute;top: 8px;right: 16px;font-size: 24px; background-color:azure;">0</div>
</html>