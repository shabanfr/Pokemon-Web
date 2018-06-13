<!DOCTYPE html>
<html>
<head>
	<title>Map</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body onload="rom('route_01')">
<script type="text/javascript">
	var body = document.getElementsByTagName("BODY")[0];
	var newDiv, seconDiv;
	var j = 0;
	player = {
		name: "Shaban",
		x: 0,
		y: 0,
		speed: 16,
		map: function(){
			document.getElementById("map").style.backgroundPosition = this.x+"px "+this.y+"px";
		},
		moveLeft: function(){
			this.x = this.x + this.speed;
			player.map();
		},
		moveRight: function(){
			this.x = this.x - this.speed;
			this.map();
		},
		moveUp: function(){
			this.y = this.y + this.speed;
			this.map();
		},
		moveDown: function(){
			this.y = this.y - this.speed;
			this.map();
		},
	};
	function move(event){
		switch (event.keyCode) {
			case 37: // Left
				player.moveLeft();
			break;

			case 38: // Up
				player.moveUp();
			break;

			case 39: // Right
				player.moveRight();
			break;

			case 40: // Down
				player.moveDown();
			break;
			}
		setTimeout(move,100);
	}

	window.addEventListener('keydown', move);
	
	function rom(a){
		if(a == "login"){
			body.style.backgroundColor = '#e0efe6';
			newDiv = document.createElement("div");
			newLoader = document.createElement("div");
			
			newDiv.id = "pokemon";
			newLoader.id = "teste";

			document.body.appendChild(newDiv);
			document.getElementById("pokemon").appendChild(newLoader);
			

			setTimeout(function(){xhr("login.php","pokemon")},3000);

		}
		else if(a == "route_01"){
			body.innerHTML = "";
			body.style.backgroundColor = '#000';
			newDiv = document.createElement("div");
			newLoader = document.createElement("div");
			newPlayer = document.createElement("div");
			
			newDiv.id = "pokemon";
			newLoader.id = "map";
			newPlayer.id = "player-skin";

			document.body.appendChild(newDiv);
			document.getElementById("pokemon").appendChild(newLoader);
			document.getElementById("map").appendChild(newPlayer);

		}
		else if(a == "generic"){
			body.innerHTML = 
			'<video autoplay>\
			  <source src="generic.mp4" type="video/mp4">\
			</video>';
			body.onkeypress = function() {
				body.innerHTML = "";
				rom('login');
				body.onkeypress = null;
			};
		}
	}
	function xhr(page, divid=false) {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(divid){
	                    if (this.responseText !== document.getElementById(divid).innerHTML) {
	                        document.getElementById(divid).innerHTML = this.responseText;
	                    }
	                }
                }
            };
            xhttp.open("GET", "pages/"+page, true);
            xhttp.send();
    }

    function connect(){
    	var a = document.getElementById("login-name").value;
    	var b = document.getElementById("login-pass").value;
    	xhr("get.php?connect="+[a,b],"result");
    	setTimeout(function(){
    		if (document.getElementById("result").innerHTML == "Connexion reussite") {
    			rom("route_01");
    		}
    	},1000);
    	
    }

</script>
</body>
</html>