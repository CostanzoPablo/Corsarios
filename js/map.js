var projector = new THREE.Projector();

var container;

var camera, scene, renderer, controls, stats;
var cameraCube, sceneCube;

var has_gl = false;

var keyboard = new THREEx.KeyboardState();
var clock = new THREE.Clock();

var delta;
var time;
var oldTime;

var cameraBaseY = 100;
var oleaje;
var planeMesh;
var uniforms;

var targetId;

var jsonLoader = new THREE.JSONLoader();

var sky;

var objectSky, objectPlane;

function changeSky(aSky){
	if (sky != aSky){
		sceneCube.remove(objectSky);
		scene.remove(objectPlane);

		if (aSky == 'morning'){
			scene.fog = new THREE.Fog( 0x440100, 0, 1500 );
			var ambient = 0x1b2434, diffuse = 0x778bFF, specular = 0xcecece, shininess = 20;
		}
		if (aSky == 'day'){
			scene.fog = new THREE.Fog( 0x333355, 0, 1000 );
			var ambient = 0x1b2434, diffuse = 0x778bFF, specular = 0xcecece, shininess = 20;			
		}
		if (aSky == 'afternoon'){
			scene.fog = new THREE.Fog( 0x5f5e6e, 0, 1000 );
			var ambient = 0x1b2434, diffuse = 0x778bFF, specular = 0xcecece, shininess = 20;
		}
		if (aSky == 'night'){
			scene.fog = new THREE.Fog( 0x101010, 0, 1200 );
			var ambient = 0x1b2434, diffuse = 0x778bFF, specular = 0xcecece, shininess = 20;			
		}
		if (aSky == 'x7'){
			scene.fog = new THREE.Fog( 0x110000, 0, 1200 );
			var ambient = 0x1b2434, diffuse = 0xCC8b8b, specular = 0xcecece, shininess = 20;			
		}		

		var path = "cube4/" + aSky + "/";
		var format = '.jpg';
		var urls = [
		path + 'px' + format, path + 'nx' + format,
		path + 'py' + format, path + 'ny' + format,
		path + 'pz' + format, path + 'nz' + format
		];

		var reflectionCube = THREE.ImageUtils.loadTextureCube( urls );

	var map = THREE.ImageUtils.loadTexture( "cube4/" + aSky + "/agua.jpg" );

map.receiveShadow = true;
	var shader = THREE.ShaderUtils.lib[ "normal" ];
	uniforms = THREE.UniformsUtils.clone( shader.uniforms );

	uniforms[ "uTime" ].value = 0.0;
	uniforms[ "uRepeat" ].value = new THREE.Vector2( 20, 16 );

	uniforms[ "enableAO" ].value = false;
	uniforms[ "enableDiffuse" ].value = false;
	uniforms[ "enableSpecular" ].value = false;
	uniforms[ "enableReflection" ].value = true;
	uniforms[ "enableDisplacement" ].value = false;

	uniforms[ "tNormal0" ].value = map;
	uniforms[ "tNormal1" ].value = map;

	uniforms[ "tNormal0" ].value.wrapS = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal0" ].value.wrapT = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal1" ].value.wrapS = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal1" ].value.wrapT = THREE.MirroredRepeatWrapping;

	uniforms[ "uNormalScale" ].value.y = -2;

	uniforms[ "uDiffuseColor" ].value.setHex( diffuse );
	uniforms[ "uSpecularColor" ].value.setHex( specular );
	uniforms[ "uAmbientColor" ].value.setHex( ambient );

	uniforms[ "uShininess" ].value = shininess;

	uniforms[ "tCube" ].value = reflectionCube;
	uniforms[ "uReflectivity" ].value = 0.3;

	uniforms[ "uDiffuseColor" ].value.convertGammaToLinear();
	uniforms[ "uSpecularColor" ].value.convertGammaToLinear();
	uniforms[ "uAmbientColor" ].value.convertGammaToLinear();


	var parameters = { fragmentShader: shader.fragmentShader, vertexShader: shader.vertexShader, uniforms: uniforms, lights: true, fog: true, transparent: false };
	var material = new THREE.ShaderMaterial( parameters );


	var planeGeometry = new THREE.PlaneGeometry(4048,3048,300,30);
	planeGeometry.computeFaceNormals();
	planeGeometry.computeVertexNormals();
	planeGeometry.computeTangents();

	planeMesh = new THREE.Mesh( planeGeometry, material );
	planeMesh.position.y = -10;
	planeMesh.rotation.x = -Math.PI/2;

	objectPlane = planeMesh;
	scene.add(objectPlane);

	// Skybox
	var shader = THREE.ShaderUtils.lib[ "cube" ];
	shader.uniforms[ "tCube" ].value = reflectionCube;

	var material = new THREE.ShaderMaterial( {

	fragmentShader: shader.fragmentShader,
	vertexShader: shader.vertexShader,
	uniforms: shader.uniforms,
	depthWrite: false,
	side: THREE.BackSide

	} ),

	mesh = new THREE.Mesh( new THREE.CubeGeometry( 100, 100, 800 ), material );
	objectSky = mesh;
	sceneCube.add( objectSky );


		sky = aSky;
	}
}

function init() {

	// SCENE
	scene = new THREE.Scene();

	// CAMERA
	var SCREEN_WIDTH = window.innerWidth, SCREEN_HEIGHT = window.innerHeight;
	var VIEW_ANGLE = 90, ASPECT = SCREEN_WIDTH / SCREEN_HEIGHT, NEAR = 1, FAR = 10000;
	camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
	
	scene.add(camera);
	camera.position.set(0,100,250);
	camera.lookAt(scene.position);

	camTarget = new THREE.Object3D();
	cubeTarget = new THREE.Vector3( 0, 0, 0 );

	cameraCube = new THREE.PerspectiveCamera( 90, window.innerWidth / window.innerHeight, 1, 10000 );
	sceneCube = new THREE.Scene();

	// LIGHTS

/*	spotLight = new THREE.SpotLight( 0xffb574, 2.5 );
	spotLight.position.set( 2100, 1000, 2300 );
	scene.add( spotLight );

	directionalLight2 = new THREE.DirectionalLight( 0xffb574, 0.4 );
	directionalLight2.position.set( -1, 1, -1 ).normalize();
	scene.add( directionalLight2 );

spotLight.castShadow = true;
directionalLight2.castShadow = true;
*/

var light = new THREE.DirectionalLight(0xffffff);
light.position.set(-3000, 100, -100);
light.target.position.set(0, 0, 0);
light.castShadow = true;
light.shadowDarkness = 0.5;
light.shadowCameraVisible = true; // only for debugging
// these six values define the boundaries of the yellow box seen above
light.shadowCameraNear = 2;
light.shadowCameraFar = 5;
light.shadowCameraLeft = -0.5;
light.shadowCameraRight = 0.5;
light.shadowCameraTop = 0.5;
light.shadowCameraBottom = -0.5;
scene.add(light);

	changeSky('morning');
	/*var path = "cube4/night/";
	var format = '.jpg';
	var urls = [
	path + 'px' + format, path + 'nx' + format,
	path + 'py' + format, path + 'ny' + format,
	path + 'pz' + format, path + 'nz' + format
	];

	var reflectionCube = THREE.ImageUtils.loadTextureCube( urls );

	var ambient = 0x1b2434, diffuse = 0x778bFF, specular = 0xcecece, shininess = 20;
	var map = THREE.ImageUtils.loadTexture( "940-v7.jpg" );

	var shader = THREE.ShaderUtils.lib[ "normal" ];
	uniforms = THREE.UniformsUtils.clone( shader.uniforms );

	uniforms[ "uTime" ].value = 0.0;
	uniforms[ "uRepeat" ].value = new THREE.Vector2( 20, 16 );

	uniforms[ "enableAO" ].value = false;
	uniforms[ "enableDiffuse" ].value = false;
	uniforms[ "enableSpecular" ].value = false;
	uniforms[ "enableReflection" ].value = true;
	uniforms[ "enableDisplacement" ].value = false;

	uniforms[ "tNormal0" ].value = map;
	uniforms[ "tNormal1" ].value = map;

	uniforms[ "tNormal0" ].value.wrapS = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal0" ].value.wrapT = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal1" ].value.wrapS = THREE.MirroredRepeatWrapping;
	uniforms[ "tNormal1" ].value.wrapT = THREE.MirroredRepeatWrapping;

	uniforms[ "uNormalScale" ].value.y = -2;

	uniforms[ "uDiffuseColor" ].value.setHex( diffuse );
	uniforms[ "uSpecularColor" ].value.setHex( specular );
	uniforms[ "uAmbientColor" ].value.setHex( ambient );

	uniforms[ "uShininess" ].value = shininess;

	uniforms[ "tCube" ].value = reflectionCube;
	uniforms[ "uReflectivity" ].value = 0.15;

	uniforms[ "uDiffuseColor" ].value.convertGammaToLinear();
	uniforms[ "uSpecularColor" ].value.convertGammaToLinear();
	uniforms[ "uAmbientColor" ].value.convertGammaToLinear();


	var parameters = { fragmentShader: shader.fragmentShader, vertexShader: shader.vertexShader, uniforms: uniforms, lights: true, fog: true, transparent: false };
	var material = new THREE.ShaderMaterial( parameters );


	var planeGeometry = new THREE.PlaneGeometry(4048,3048,300,30);
	planeGeometry.computeFaceNormals();
	planeGeometry.computeVertexNormals();
	planeGeometry.computeTangents();

	planeMesh = new THREE.Mesh( planeGeometry, material );
	planeMesh.position.y = -10;
	planeMesh.rotation.x = -Math.PI/2;

	objectPlane = planeMesh;
	scene.add(objectPlane);

	// Skybox
	var shader = THREE.ShaderUtils.lib[ "cube" ];
	shader.uniforms[ "tCube" ].value = reflectionCube;

	var material = new THREE.ShaderMaterial( {

	fragmentShader: shader.fragmentShader,
	vertexShader: shader.vertexShader,
	uniforms: shader.uniforms,
	depthWrite: false,
	side: THREE.BackSide

	} ),

	mesh = new THREE.Mesh( new THREE.CubeGeometry( 100, 100, 800 ), material );
	objectSky = mesh;
	sceneCube.add( objectSky );*/

	// RENDERER
	if ( Detector.webgl ){
	renderer = new THREE.WebGLRenderer( {antialias:true} );
	has_gl = true;
	}else{
	renderer = new THREE.CanvasRenderer(); 
	}
	renderer.autoClear = false;
	renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);

renderer.shadowMapEnabled = true;
renderer.shadowMapSoft = true;

renderer.shadowCameraNear = 3;
renderer.shadowCameraFar = camera.far;
renderer.shadowCameraFov = 50;

renderer.shadowMapBias = 0.0039;
renderer.shadowMapDarkness = 1;
renderer.shadowMapWidth = 1024;
renderer.shadowMapHeight = 1024;


	container = document.getElementById( 'ThreeJS' );
	container.appendChild( renderer.domElement );
	// EVENTS
	THREEx.WindowResize(renderer, camera);
	THREEx.FullScreen.bindKey({ charCode : 'm'.charCodeAt(0) });
	// CONTROLS
	controls = new THREE.OrbitControls( camera, renderer.domElement );
	// STATS
	stats = new Stats();
	stats.domElement.style.position = 'absolute';
	stats.domElement.style.bottom = '0px';
	stats.domElement.style.zIndex = 100;
	container.appendChild( stats.domElement );

}

function onWindowResize() {

	windowHalfX = window.innerWidth / 2;
	windowHalfY = window.innerHeight / 2;

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	cameraCube.aspect = window.innerWidth / window.innerHeight;
	cameraCube.updateProjectionMatrix();

	renderer.setSize( window.innerWidth, window.innerHeight );

}

/*function animate() {
    requestAnimationFrame( animate );
	render();
	update();
}*/

			//var t = 0;
			//var clock = new THREE.Clock();
			//var skin;
			function animate() {
				requestAnimationFrame( animate );
				/*var delta = clock.getDelta();

				

				if ( t > 1 ) t = 0;

				if ( skin ) {

					// guess this can be done smarter...

					// (Indeed, there are way more frames than needed and interpolation is not used at all
					//  could be something like - one morph per each skinning pose keyframe, or even less,
					//  animation could be resampled, morphing interpolation handles sparse keyframes quite well.
					//  Simple animation cycles like this look ok with 10-15 frames instead of 100 ;)

					for ( var i = 0; i < skin.morphTargetInfluences.length; i++ ) {

						skin.morphTargetInfluences[ i ] = 0;

					}

					skin.morphTargetInfluences[ Math.floor( t * 30 ) ] = 1;

					t += delta;

				}*/

				render();
				update();
				//stats.update();

			}

function update()
{
	if ( keyboard.pressed("z") ) 
	{ 
	// do something
	}

	controls.update();
	stats.update();
	cronChecks();
}

function render() 
{
	time = new Date().getTime();
	delta = time - oldTime;
	oldTime = time;

	if (isNaN(delta) || delta > 1000 || delta == 0 ) {
		delta = 1000/60;
	}

	graficarDisparos(delta);
	coolDowns(delta);
	updateVirar();
	updateVida();

	uniforms.uTime.value += delta*0.005;


	if (mouseDown && controls.enabled == true){
		cameraBaseY = camera.position.y;				
	}else{
		antiSalto = Math.abs(Math.cos(uniforms.uTime.value*0.20)*10 - oleaje);
		if (antiSalto > 2){
			oleaje = 0;//esperar hasta enganchar la onda de la ola nuevamente... 
		}else{
			oleaje = Math.cos(uniforms.uTime.value*0.20)*10;
		}
		camera.position.y = cameraBaseY + oleaje;
	}

	cubeTarget.y = - camera.position.y-20;//-20 esconde las puntas del cuadrado de agua en el fondo del mapa junto con la nievla

	cubeTarget.x = - camera.position.x;
	
	cubeTarget.z = - camera.position.z;
	  
	radarRotar(Math.atan2(cubeTarget.x, cubeTarget.z));

	cameraCube.lookAt( cubeTarget );
	    
	if (has_gl) {
	    renderer.clear();
	    renderer.render( sceneCube, cameraCube );
	    renderer.render( scene, camera );
	}
}