var FoodName;
var FoodType;
var Quantity;
var data;
var obj;
var furtherobj;
var positionX;
var positionY;
var mapCount = 0;

function filterByLocation(judgingValue){
	var printobj = new Array ();
			for(var m=0;m<obj.length;m++){
			
			var comparePositionX=obj[m].LocationX;
			var comparePositionY=obj[m].LocationY;
			
			var JudgingValue = judgingValue; 
			var LatLng1 = new google.maps.LatLng(positionX,positionY);
			var LatLng2 = new google.maps.LatLng(comparePositionX,comparePositionY);
			
		
			var distanceMeter = google.maps.geometry.spherical.computeDistanceBetween(LatLng1, LatLng2);
			
			if(distanceMeter < JudgingValue){
				
				printobj.push(obj[m]);
				
			}
			else {
			
			}
			
		}
		printTable(printobj);
		furtherobj = copyArray(printobj);
}

function showInAMap(){
    var latlng =  new google.maps.LatLng(positionX, positionY);
    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    if(mapCount==0){
        var d = document.createElement("div");
        d.id ="map";
        d.style.cssText="width:100%;height:500px;";
        showMap.appendChild(d);}
    mapCount++;
    var map = new google.maps.Map(document.getElementById("map"), myOptions);
    mapCount++;

    for (var m = 0; m < furtherobj.length; m++) {

        var comparePositionX=furtherobj[m].LocationX;
        var comparePositionY=furtherobj[m].LocationY;

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(comparePositionX, comparePositionY),
            map: map
        });

        showInfo(marker,m);

    }



}
function showInfo(marker,m){
    var infoWindow = new google.maps.InfoWindow({
        content:"<br/><form class= \"name\" method = \"get\" action = \"itemPage.php\" onsubmit=\"return tool1()\">\n" +
        "<input type=\"hidden\" value=\" \" name=\"hid\" index="+furtherobj[m].FoodID+">\n" +
        "<input type=\"submit\" style=\"width: -moz-fit-content \" value="+furtherobj[m].FoodName+">\n" +
        "</form>"+"Quantity:"+furtherobj[m].Quantity
    });


    google.maps.event.addListener(marker, 'click', function() {

        infoWindow.open(map,marker);

    });

}





function copyArray(arr){
  var result = [];
  result = arr.slice();
  return result;
}

function searchLocation(keywords){
	var address = keywords;
	var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address' : address }, 
			function(results, status) { 
				
                if (status == google.maps.GeocoderStatus.OK) {    
                    //依据解析的经度纬度设置坐标居中  
					
					var coords = results[0].geometry.location;
					
					
					positionX =  results[0].geometry.location.lat();
            		positionY = results[0].geometry.location.lng();
					var pass = [positionX,positionY];
            		
                    return pass;
                } else {    
                    alert("Geocode was not successful for the following reason: " + status);    
                }    
            }); 
	
}
function getCurrentLocation(){
	if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
			var coords = position.coords; 
            positionX = position.coords.latitude;
            positionY = position.coords.longitude;
			var pass = [positionX,positionY];
            return pass;
			  }, function(error) {
            alert("Please allow location access!");
          });
        } else {
          // Browser doesn't support Geolocation
          alert("This browser is not fit!");
        }
}

function distanceCounting(judgingValue){
			var printobj = new Array ();
			for(var m=0;m<obj.length;m++){
			
			var comparePositionX=obj[m].LocationX;
			var comparePositionY=obj[m].LocationY;
			
			var JudgingValue = judgingValue; 
			var LatLng1 = new google.maps.LatLng(positionX,positionY);
			var LatLng2 = new google.maps.LatLng(comparePositionX,comparePositionY);
			
			
			var distanceMeter = google.maps.geometry.spherical.computeDistanceBetween(LatLng1, LatLng2);
			
			if(distanceMeter < JudgingValue){
		
				printobj.push(obj[m]);
				
			}

			
		}
		printTable(printobj);
		
		obj = copyArray(printobj);
		furtherobj = copyArray(printobj);
		
		
		
}
	


function doLocation(){
	
	var Location = document.getElementById("Location").value;
	if(Location.replace(/(^\s*)|(\s*$)/g, "") !== ""){
	
		//do searching with keyword
		var address = Location;
		var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address' : address }, 
			function(results, status) { 
				
                if (status == google.maps.GeocoderStatus.OK) {    
                      
				
					var coords = results[0].geometry.location;
					
			
					positionX =  results[0].geometry.location.lat();
            		positionY = results[0].geometry.location.lng();
            	
					distanceCounting(5000);
                } else {    
                    alert("Geocode was not successful for the following reason: " + status);    
                }    
            }); 
		
		
		
		
	}
	else if (Location.replace(/(^\s*)|(\s*$)/g, "") === ""){
	
		// get current location
		if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
			var coords = position.coords; 
            positionX = position.coords.latitude;
            positionY = position.coords.longitude;
		
			  distanceCounting(5000);
			  }, function(error) {
            alert("Please allow location access!");
          });
        } else {
          // Browser doesn't support Geolocation
          alert("This browser is not fit!");
        }
		
		
		
		
	}
		
}


function search(data) {
    var xhr = null;
	
    if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {    // IE 8 and older
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
    }

    xhr.open("POST", "SearchFunction.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = display_data;
    function display_data() {
        if (xhr.readyState == 4) {

            if (xhr.status == 200) {
       

                var returnMessage = xhr.responseText;
				
				
                //alert("can return");
                //alert(returnMessage);
                obj = JSON.parse(returnMessage);
				
				if(!obj && typeof(obj)!="undefined" && obj!=0){
					alert("No Result In Database");
				}
				else{doLocation();}
                //alert ("can parse");
                //printObj();
                


                //console.log(obj.sort(sorting('ReleaseDate')))

                // var name = new Array();
                //
                // for(var i = 0;i<obj.length;i++){
                //     name[i] = obj[i].FoodName;
                // }
                //
                //
                // document.getElementById("output").innerText= name;
            } 
        }
        

    }
}
function tool() {
    var frm = window.event.srcElement;
    frm.hid.value = $(frm.hid).attr("index");
    return true;

}
function printTable(obj){
	
//    var tb = document.getElementById("output");

    // for(var n= tb.rows.length-1;n>0;n--){
    //     tb.deleteRow(n);
    // }
	
    var name = new Array();
    var photo = new Array();
    var id = new Array();
    var quantity = new Array();
	
    for (var j = 0; j < obj.length; j++) {
        name[j] = obj[j].FoodName;
        photo[j] = obj[j].Image;
        id[j] = obj[j].FoodID;
        quantity[j] = obj[j].Quantity;
    }
    var html = '';
    html+='<tr>';
    html+='<td>Photo</td>';
    html+='<td>FoodName</td>';
    html+='<td>Quantity</td>';
    html+='</tr>';
//<tr><td><h5>Photo</h5></td><td><h5>FoodName</h5></td><td><h5>Quantity</h5></td></tr>
    for(var m=0; m < obj.length; m++){
        html+='<tr>';
        html += '<td>' + "<img width=\"100\" height=\"66\" src='data:image;base64," + photo[m] + "'>" + '</td>';
        html +='<td>';
        html+="<form method = \"get\" action = \"itemPage.php\" onsubmit = \"return tool()\">";
        html+="<input type=\"hidden\"  name=\"hid\" value = \"\" index = "+ id[m]+">";
        html+="<input type = \"submit\" class=\"btn\" value="+name[m]+">";
        //"<input type=\"radio\" name=\"select\" id=" + id[i] + " >"
        html+="</form>";
        html+='</td>';
        html+='<td>'+quantity[m]+'</td>';
        html+='</tr>';
        // var row = tb.insertRow(tb.rows.length);
        // var c1 = row.insertCell(0);
        // c1.innerHTML = obj[m].Image;
        // var c2 = row.insertCell(1);
        //
        //
        // c2.innerHTML = html;
        //     //obj[m].FoodName;
        // var c3 = row.insertCell(2);
        // c3.innerHTML = obj[m].Quantity;

    }
    
    document.querySelector(".output").innerHTML = html;

}

// function sorting(ReleaseDate) {
//
//     return function (a,b) {
//         var value1 = a[ReleaseDate];
//         alert("3");
//         alert(value1);
//         var value2 = b[ReleaseDate];
//         return value1 -value2;
//
//     }
//
// }
//console.log(obj.sort(sorting('ReleaseDate')))



// function printObj() {
//     //alert("3");
//     var name = new Array();
//
//     for(var i = 0;i<obj.length;i++){
//         name[i] = obj[i].FoodName;
//     }
//
//     //alert(name[0]);
//     document.getElementById("output").innerText= name;
//
// }
function doSearch(){
	
    FoodName = document.getElementById("FoodName").value;
    FoodType = document.getElementById("FoodType").value;
    Quantity = document.getElementById("Quantity").value;
	var Location = document.getElementById("Location").value;
    if(FoodName.replace(/(^\s*)|(\s*$)/g, "") !== "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") === ""&& Quantity.replace(/(^\s*)|(\s*$)/g, "") === ""){
        data = "action=searchName&name="+FoodName;
        search(data);
		



    }else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") === "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") !== "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") === ""){
        data = "action=searchType&foodType="+FoodType;
        search(data);


    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") === "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") === "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") !== ""){
        data = "action=searchQuantity&quantity="+Quantity;
        search(data);

    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") !== "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") !== "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") === ""){
        data = "action=searchTypeName&name="+FoodName+"&foodType="+FoodType;
        search(data);

    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") !== "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") === "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") !== ""){
     
        data = "action=searchQuantityName&name="+FoodName+"&quantity="+Quantity;
        search(data);

    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") === "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") !== "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") !== ""){
        data = "action=searchTypeQuantity&foodType="+FoodType+"&quantity="+Quantity;
        search(data);

    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") !== "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") !== "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") !== ""){
        data = "action=searchAll&name="+FoodName+"&foodType="+FoodType+"&quantity="+Quantity;
        search(data);

    }
    else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") === "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") === "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") === ""&& Location.replace(/(^\s*)|(\s*$)/g, "") !== ""){
        data = "action=searchLocation";
        search(data);
    }
	else if(FoodName.replace(/(^\s*)|(\s*$)/g, "") === "" && FoodType.replace(/(^\s*)|(\s*$)/g, "") === "" && Quantity.replace(/(^\s*)|(\s*$)/g, "") === ""&& Location.replace(/(^\s*)|(\s*$)/g, "") === ""){
        alert("Please input all data");
    }
    var page=document.getElementById("page");
    page.style.cssText="visibility:hidden;";

}
//sort release date
function compareData(a, b){
    return b['FoodID'] - a['FoodID'];
}

//sort popular
function compareLike(a,b){
    //console.log(json);
    // for(var j=0,jl=json.length;j < jl;j++){
    //     var temp = json[j],
    //         val  = temp[key],
    //         i    = j-1;
    //     while(i >=0 && json[i][key]<=val){
    //         json[i+1] = json[i];
    //         i = i-1;
    //     }
    //     json[i+1] = temp;
    //
    // }
    // //console.log(json);
    // return json;
    // return json.sort(function(a, b) {
    //     var x = a[key]; var y = b[key];
    //     return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    // });
    return b['Likes'] - a['Likes'];
}

function sorting(field) {

    var data_ = obj;
    var newData;
    //returnMessage;
    //. alert(data);
    // data.sort(comp);
    if(field=="Latest release"){
        newData = data_.sort(compareData);

    }
    else if(field=="Most popular"){
        newData = data_.sort(compareLike);
        //newData = compareLike(data_,'Likes');

    }else {
        newData = obj;
    }
   // alert(newData);
    printTable(newData);

}

//filter with days
function filtDays(filt_data,sub_days){
    // var flag;
    var myDate = new Date();
    var sub;
    var result = [];
    // var result2 = [];
    // var result3 = [];
    for(var i=0; i<filt_data.length;i++){
        sub = myDate.getTime() - new Date(filt_data[i]['ReleaseDate']).getTime();
        var days = sub / (1000 * 60 * 60 * 24);
        // alert(days);
        // for(var j=0;j<)
        if(days<sub_days){
            result.push(filt_data[i]);
            //   result[i] = filt_data[i];
        }

    }
    return result;

}
function filtering(filt) {
    //  var filt_data = obj;
    var new_data;
    var sub_days;
    if(filt == "Release within 1 day"){
        var sub_days = 1;
        new_data = filtDays(obj,sub_days);
	
    printTable(new_data);
		furtherobj = copyArray(new_data);
    }
    else if(filt == "Release within 3 days"){
        var sub_days = 3;
        new_data = filtDays(obj,sub_days);
	
    printTable(new_data);
		furtherobj = copyArray(new_data);
    }
    else if(filt == "Release within 5 days"){
        var sub_days = 5;
        new_data = filtDays(obj,sub_days);
	
    printTable(new_data);
		furtherobj = copyArray(new_data);
    }
    else if(filt == "Location within 500m"){
	
        filterByLocation(500);

    }
	else if(filt == "Location within 1km"){
	
        filterByLocation(1000);

    }
	else if(filt == "Location within 3km"){
	
        filterByLocation(3000);
    }
	else{alert("sth is wrong");}
    showInAMap();

}


