function loadUrls(){$.ajax({url:'./queries/fetch_urls.php',method:'POST',data:{'foo':'bar',},success:function(data){var urls=JSON.parse(data);for(var i=0,lan=urls.length;i<lan;i++)
addAUrlToTable(urls[i],"#urls_table");}})}
function addAUrlToTable(url,table){var tr=$(document.createElement('tr'));appendTextToRow(url.id,tr);appendURLToRow(url.url,tr);appendTextToRow(url.valide,tr);appendButtonToRow("./img/red-x.png",deleteUrlFromTable,tr);$(table).append(tr)}
function deleteUrlFromTable(element){var row=element.parent();var urlId=row.children()[0].innerHTML;var go=confirm("Delete url: "+urlId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_url.php',method:'POST',data:{'foo':'bar','id':urlId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");urlsSection()}})}
function loadSavedVideos(){$.ajax({url:'./queries/fetch_users.php',method:'POST',data:{'foo':'bar',},success:function(data){var videos=JSON.parse(data);for(var i=0,lan=videos.length;i<lan;i++)
addAVideoToTable(videos[i],"#saved_users");}})}
function loadSavedEmails(){$.ajax({url:'./queries/fetch_emails.php',method:'POST',data:{'foo':'bar',},success:function(data){var videos=JSON.parse(data);for(var i=0,lan=videos.length;i<lan;i++)
addAnEmailToTable(videos[i],"#saved_emails");}})}
function loadSavedCoffees(){$.ajax({url:'./queries/fetch_coffees.php',method:'POST',data:{'foo':'bar',},success:function(data){var videos=JSON.parse(data);for(var i=0,lan=videos.length;i<lan;i++)
addACoffeeToTable(videos[i],"#saved_coffees");}})}
function loadSavedComments(){$.ajax({url:'./queries/fetch_comments.php',method:'POST',data:{'foo':'bar',},success:function(data){var videos=JSON.parse(data);for(var i=0,lan=videos.length;i<lan;i++)
addACommentToTable(videos[i],"#saved_comments");}})}
function loadPendingVideos(){$.ajax({url:'./queries/fetch_pending_videos.php',method:'POST',data:{'foo':'bar',},success:function(data){var videos=JSON.parse(data);for(var i=0,lan=videos.length;i<lan;i++)
addAPendingVideoToTable(videos[i],"#pending_videos_table");}})}
function addAPendingVideoToTable(video,table){var tr=$(document.createElement('tr'));tr.attr("id",video.id);appendTextToRow(video.id,tr);appendTextToRow(video.title,tr);appendTextToRow(video.image,tr);appendTextToRow(video.studio,tr);appendTextToRow(video.description,tr);$.ajax({url:'./queries/fetch_pending_video_url.php',method:'POST',data:{'foo':'bar','id':video.id},success:function(data){var urls=JSON.parse(data);var urlArray=new Array(urls.length);for(var i=0;i<urls.length;i++){urlArray.push(urls[i].url)}
appendListToRow(urlArray,tr);$.ajax({url:'./queries/fetch_pending_video_categories.php',method:'POST',data:{'foo':'bar','id':video.id},success:function(data){var categories=JSON.parse(data);var categoriesArray=new Array(categories.length);for(var i=0;i<categories.length;i++){categoriesArray.push(categories[i].url)}
appendListToRow(categoriesArray,tr);appendButtonToRow("./img/modify.png",modifyPendingVideo,tr);appendButtonToRow("./img/red-x.png",deletePendingVideo,tr);$(table).append(tr)}})}})}
function deletePendingVideo(element){var row=element.parent();var videoId=row.attr("id");var go=confirm("Delete video: "+videoId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_pending_video.php',method:'POST',data:{'foo':'bar','id':videoId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");pendingSection()}})}
function modifyPendingVideo(element){var row=element.parent();console.log(row);var tdArray=row.children();for(var i=0;i<tdArray.length;i++){console.log(tdArray[i])}}
function addAVideoToTable(video,table){var tr=$(document.createElement('tr'));appendTextToRow(video.id,tr);appendTextToRow(video.name,tr);appendTextToRow(video.last_name,tr);appendTextToRow(video.birthday,tr);appendTextToRow(video.username,tr);appendTextToRow(video.password,tr);appendTextToRow(video.melh,tr);appendTextToRow(video.email,tr);appendTextToRow(video.sub_date,tr);appendTextToRow(video.verified,tr);appendTextToRow(video.authority,tr);appendButtonToRow("./img/red-x.png",deleteVideoFromTable,tr);$(table).append(tr)}
function addAnEmailToTable(video,table){var tr=$(document.createElement('tr'));appendTextToRow(video.id,tr);appendTextToRow(video.local_part+"@"+video.domain_name+"."+video.domain_tld,tr);appendButtonToRow("./img/red-x.png",deleteEmailFromTable,tr);$(table).append(tr)}
function addACoffeeToTable(video,table){var tr=$(document.createElement('tr'));appendTextToRow(video.id,tr);appendTextToRow(video.name,tr);appendTextToRow(video.description,tr);appendTextToRow(video.latitude,tr);appendTextToRow(video.longitude,tr);appendTextToRow(video.image_path,tr);appendTextToRow(video.street_address,tr);appendTextToRow(video.phone,tr);appendButtonToRow("./img/red-x.png",deleteCoffeeFromTable,tr);$(table).append(tr)}
function addACommentToTable(video,table){var tr=$(document.createElement('tr'));appendTextToRow(video.id,tr);appendTextToRow(video.username,tr);appendTextToRow(video.comment,tr);appendTextToRow(video.name,tr);appendTextToRow(video.comment_date,tr);appendButtonToRow("./img/red-x.png",deleteCommentFromTable,tr);$(table).append(tr)}
function deleteCommentFromTable(element){var row=element.parent();var videoId=row.children()[0].innerHTML;var go=confirm("Delete Comment: "+videoId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_comment.php',method:'POST',data:{'foo':'bar','id':videoId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");getComments()}})}
function deleteCoffeeFromTable(element){var row=element.parent();var videoId=row.children()[0].innerHTML;var go=confirm("Delete Coffee: "+videoId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_coffee.php',method:'POST',data:{'foo':'bar','id':videoId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");getCoffees()}})}
function deleteVideoFromTable(element){var row=element.parent();var videoId=row.children()[0].innerHTML;var go=confirm("Delete User: "+videoId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_user.php',method:'POST',data:{'foo':'bar','id':videoId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");getUsers()}})}
function deleteEmailFromTable(element){var row=element.parent();var videoId=row.children()[0].innerHTML;var go=confirm("Delete Email: "+videoId+" ?");if(!go)
return;$.ajax({url:'./queries/delete_email.php',method:'POST',data:{'foo':'bar','id':videoId},success:function(data){if(data==!1)
alert("didn't delete anything");else alert("Done");getEmails()}})}
function addACategoryToTable(category,table){var tr=$(document.createElement('tr'));appendTextToRow(category.id,tr);appendTextToRow(category.name,tr);appendTextToRow(category.image,tr);appendTextToRow(category.nbr_videos,tr);$(table).append(tr)}
function loadCatOrStdIntoSection(section){var query;var table;if(section=="categories"){url="./queries/fetch_categories.php";table="#categories_table"}else if(section=="studios"){url="./queries/fetch_studios.php";table="#studios_table"}else{return}
$.ajax({url:url,method:'POST',data:{'foo':'bar',},success:function(data){var categories=JSON.parse(data);for(var i=0,lan=categories.length;i<lan;i++)
addACategoryToTable(categories[i],table);}})}
function addStudio(){globalAdd("studios")}
function addCategory(){globalAdd("categories")}
function globalAdd(section){var inputName,path,preQuery,table
if(section=="categories"){inputName='input[name="categoryName"]';path='../../public/categories';url="./queries/insert_category.php";table="#categories_table"}else if(section=="studios"){inputName='input[name="studioName"]';path='../../public/studios';url="./queries/insert_studio.php";table="#studios_table"}else{console.error("The sepecified section is wrong!");return}
var catStdName=$(inputName).val().trim();var imageUrl=$('input[name="image"]').val().trim();if(catStdName==""||imageUrl==""){alert("Neither fields must be empty");return}
$.ajax({url:'./queries/download_image.php',method:'POST',data:{'foo':'bar','url':imageUrl,'name':catStdName,'path':path,},success:function(data){var imageName=data;if(imageName==!1||imageName.length<=4){alert("Image Name is not right: "+imageName);return}
$.ajax({url:url,method:'POST',data:{'foo':'bar','name':catStdName,'image':imageName},success:function(data){if(data==!1){alert("Could not insert data!");return}
var categoriesTable=$(table);categoriesTable.empty();categoriesTable.append("<th><tr><td>id</td><td>"+section+"</td><td>Image</td><td>Nbr vids</td></tr></th>");loadCatOrStdIntoSection(section);$(inputName).val('');$('input[name="image"]').val('');alert(catStdName+" added")}})}})}
function verifyMe(){window.open($('input[name="image"]').val(),'_blank')}
function fromDatabaseToTable(url,tableId,activeFunction,className){$.ajax({url:url,method:'POST',data:{'foo':'bar',},success:function(data){var obj=JSON.parse(data);if(obj.length!=0){$("#"+tableId+"_empty").remove()}
else{return}
var i=0;var lan=obj.length;while(i<lan){var tr=$(document.createElement("tr"));var j=0;while(j<10&&i<lan){var td=$(document.createElement("td"));td.append(obj[i].name);td.attr("value",obj[i].id);td.click(function(e){activeFunction($(this),className)});tr.append(td);i++;j++}
$("#"+tableId).append(tr)}}})}
function categoryElements(element,className){element.toggleClass(className)}
function sutdiosElements(element,className){var activeElement=$("."+className);if(activeElement[0]){activeElement.toggleClass(className)}
element.toggleClass(className)}
var videos={nbrRows:0};var modifiedVideo={status:!1,id:null};var users={nbrRows:0};var modifiedUser={status:!1,id:null};function addItUser(){if(modifiedVideo.status){delete videos[modifiedVideo.id];$("table#pending_table tr#"+modifiedVideo.id).remove();modifiedVideo.status=!1;modifiedVideo.id=null}
var currentUser=fetchUser();users.nbrRows=users.nbrRows+1;users[users.nbrRows]=currentUser;addToPendingUserTable(currentUser,users.nbrRows);$('input').val('')}
var coffees={nbrRows:0};var modifiedCoffee={status:!1,id:null};function addItCoffee(){if(modifiedVideo.status){delete videos[modifiedVideo.id];$("table#pending_table tr#"+modifiedVideo.id).remove();modifiedVideo.status=!1;modifiedVideo.id=null}
var currentUser=fetchCoffee();coffees.nbrRows=coffees.nbrRows+1;coffees[coffees.nbrRows]=currentUser;addToPendingCoffeeTable(currentUser,coffees.nbrRows);$('input').val('');$('textarea').val('')}
function addIt(){if(modifiedVideo.status){delete videos[modifiedVideo.id];$("table#pending_table tr#"+modifiedVideo.id).remove();modifiedVideo.status=!1;modifiedVideo.id=null}
var currentVideo=fetchInputs();videos.nbrRows=videos.nbrRows+1;videos[videos.nbrRows]=currentVideo;addToPendingTable(currentVideo,videos.nbrRows);clearAll()}
function clearAll(){$('input[name="title"]').val('');$('textarea').val('');$('input[name="image"]').val('');$('input[name="video_url"]').val('');$('input[name="video_url"]').attr('number','1');$('#more_video_url').empty();var activeCategories=$('.active_category');for(var i=0;i<activeCategories.length;i++){activeCategories[i].classList.remove('active_category')}
$('.active_studio').toggleClass('active_studio')}
function addToPendingTable(videoObject,rowId){var tr=$(document.createElement("tr"));tr.attr("id",rowId);appendTextToRow(videoObject.cin,tr);appendTextToRow(videoObject.nom,tr);appendTextToRow(videoObject.prenom,tr);appendTextToRow(videoObject.login,tr);var categoriesTmp=videoObject.categories.map(function(d){return d.name});appendListToRow(categoriesTmp,tr);appendTextToRow(videoObject.studio.name,tr);appendTextToRow("",tr);appendButtonToRow("./img/modify.png",modifyDblClick,tr);appendButtonToRow("./img/red-x.png",deleteDblClick,tr);appendCheckToRow(tr);$("#pending_table").append(tr)}
function addToPendingUserTable(videoObject,rowId){var tr=$(document.createElement("tr"));tr.attr("id",rowId);appendTextToRow(videoObject.name,tr);appendTextToRow(videoObject.lastName,tr);appendTextToRow(videoObject.birthday,tr);appendTextToRow(videoObject.username,tr);appendTextToRow(videoObject.password,tr);appendTextToRow(videoObject.email,tr);appendTextToRow(videoObject.verified,tr);appendTextToRow(videoObject.authority,tr);appendTextToRow("",tr);appendButtonToRow("./img/modify.png",modifyDblClick,tr);appendButtonToRow("./img/red-x.png",deleteUserDblClick,tr);$("#pending_user_table").append(tr)}
function addToPendingCoffeeTable(videoObject,rowId){var tr=$(document.createElement("tr"));tr.attr("id",rowId);appendTextToRow(videoObject.name,tr);appendTextToRow(videoObject.description,tr);appendTextToRow(videoObject.latitude,tr);appendTextToRow(videoObject.longitude,tr);appendTextToRow(videoObject.imagePath,tr);appendTextToRow(videoObject.streetAddress,tr);appendTextToRow(videoObject.phone,tr);appendTextToRow("",tr);appendButtonToRow("./img/modify.png",modifyDblClick,tr);appendButtonToRow("./img/red-x.png",deleteDblClick,tr);$("#pending_coffe_table").append(tr)}
function appendButtonToRow(image,dblclickFunction,row){var img=$(document.createElement('img'));img.attr("src",image);img.toggleClass("table_img");var td=$(document.createElement("td"));td.append(img);td.dblclick(function(e){dblclickFunction($(this))});row.append(td)}
function deleteDblClick(element){var row=element.parent();var rowId=row.attr("id");delete videos[rowId];row.remove()}
function deleteUserDblClick(element){var row=element.parent();var rowId=row.attr("id");delete users[rowId];row.remove()}
function modifyDblClick(element){if(modifiedVideo.status){modifiedVideo.status=!1;modifiedVideo.id=null;clearAll();element.parent().css("background-color","white");return}
var row=element.parent();row.css("background-color","#C1AEAE");var rowId=row.attr("id");var currentVideo=videos[rowId];$('input[name="title"]').val(currentVideo.title);$('textarea').val(currentVideo.description);$('input[name="image"]').val(currentVideo.image);$("#categories_table td").each(function(){for(var i=0;i<currentVideo.categories.length;i++){if($(this).text()==currentVideo.categories[i]){$(this).toggleClass("active_category")}}});$("#studios_table td").each(function(){if($(this).text()==currentVideo.studio){$(this).toggleClass("active_studio")}});$('input[name="video_url"]').val(currentVideo.videoURL[0]);var numberURLs=currentVideo.videoURL.length;for(var i=2;i<=numberURLs;i++){addVideoURL();$('input[name="video_url'+i+'"]').val(currentVideo.videoURL[i-1])}
modifiedVideo.status=!0;modifiedVideo.id=rowId}
function appendTextToRow(data,row){var td=$(document.createElement("td"));td.append(data);row.append(td)}
function appendURLToRow(url,row){var td=$(document.createElement("td"));var a=$(document.createElement("a"));a.attr("href",url);a.attr("target","_blank");a.append(url);td.append(a);row.append(td)}
function appendListToRow(list,row){var td=$(document.createElement("td"));var ul=$(document.createElement("ul"));for(var i=0,lan=list.length;i<lan;i++){var li=$(document.createElement("li"));li.append(list[i]);ul.append(li)}
td.append(ul);row.append(td)}
function appendURLListToRow(list,row){var td=$(document.createElement("td"));var ul=$(document.createElement("ul"));for(var i=0,lan=list.length;i<lan;i++){var li=$(document.createElement("li"));var a=$(document.createElement("a"));a.attr("href",list[i]);a.attr("target","_blank");a.append(list[i]);li.append(a);ul.append(li)}
td.append(ul);row.append(td)}
function fetchInputs(){var cin=$('input[name="CIN"]').val();var nom=$('input[name="nom"]').val();var prenom=$('input[name="prenom"]').val();var login=$('input[name="login"]').val();var password=$('input[name="password"]').val();var groupe={};var currentStudio=$(".active_studio");groupe.name=currentStudio.text();groupe.id=currentStudio.attr("value");var info={};info.cin=cin;info.nom=nom;info.prenom=prenom;info.login=login;info.password=password;info.groupe=groupe;return info}
function fetchUser(){var name=$('input[name="name"]').val();var lastName=$('input[name="last_name"]').val();var birthday=$('input[name="brith_date"]').val();var username=$('input[name="username"]').val();var password=$('input[name="password"]').val();var email=$('input[name="email"]').val();var verified=$('select[name="verified"]').val()
var authority=$('select[name="authority"]').val()
var user={};user.name=name;user.lastName=lastName;user.birthday=birthday;user.username=username;user.password=password;user.email=email;user.verified=verified;user.authority=authority;return user}
function fetchCoffee(){var name=$('input[name="name"]').val();var description=$('textarea[name="description"]').val();var latitude=$('input[name="latitude"]').val();var longitude=$('input[name="longitude"]').val();var imagePath=$('input[name="image_path"]').val();var streetAddress=$('input[name="street_address"]').val();var phone=$('input[name="phone"]').val();var coffee={};coffee.name=name;coffee.description=description;coffee.latitude=latitude;coffee.longitude=longitude;coffee.imagePath=imagePath;coffee.streetAddress=streetAddress;coffee.phone=phone;return coffee}
function addVideoURL(){var urlNbr=parseInt($('input[name="video_url"]').attr("number"));$('input[name="video_url"]').attr("number",urlNbr+1);$("#more_video_url").append('<input type="text" name="video_url'+(urlNbr+1)+'"placeholder="URL" required><br/>')}
function saveAll(){var str_videos=JSON.stringify(videos);$.ajax({method:'POST',url:'./queries/add_videos.php',contentType:"application/json",data:str_videos,success:function(data){var videosResult=JSON.parse(data);for(var i=1;i<=videos.nbrRows;i++){if(i in videos){var statusImg=$(document.createElement("img"));statusImg.addClass("table_img");if(videosResult[i]=='success'){statusImg.attr("src","./img/added.png")}else if(videosResult[i]=='pending'){statusImg.attr("src","./img/pending.jpg")}
$('#'+i+" td:nth-child(7)").append(statusImg);delete videos[i]}}}})}
function saveAllUsers(){var str_videos=JSON.stringify(users);$.ajax({method:'POST',url:'./queries/add_users.php',contentType:"application/json",data:str_videos,success:function(data){var videosResult=JSON.parse(data);for(var i=1;i<=users.nbrRows;i++){if(i in users){var statusImg=$(document.createElement("img"));statusImg.addClass("table_img");if(videosResult[i]=='success'){statusImg.attr("src","./img/added.png")}else if(videosResult[i]=='refused'){statusImg.attr("src","./img/pending.jpg")}
$('#'+i+" td:nth-child(9)").append(statusImg);delete users[i]}}}})}
function saveAllCoffees(){var str_videos=JSON.stringify(coffees);$.ajax({method:'POST',url:'./queries/add_coffees.php',contentType:"application/json",data:str_videos,success:function(data){var videosResult=JSON.parse(data);for(var i=1;i<=coffees.nbrRows;i++){if(i in coffees){var statusImg=$(document.createElement("img"));statusImg.addClass("table_img");if(videosResult[i]=='success'){statusImg.attr("src","./img/added.png")}else if(videosResult[i]=='refused'){statusImg.attr("src","./img/pending.jpg")}
$('#'+i+" td:nth-child(8)").append(statusImg);delete coffees[i]}}}})}
var toggleImport={status:!1};function importVideos(){if(!toggleImport.status){var txtArea=$(document.createElement("textarea"));txtArea.attr("placeholder","Import Videos");txtArea.toggleClass("import_text_area");txtArea.attr("name","data");txtArea.attr("type","text");$("#import_section").append(txtArea);toggleImport.status=!0}else{var importVal=$("#import_section textarea").serialize();$.ajax({url:'./queries/convert_videos.php',type:'post',data:importVal,success:function(data){var vds=JSON.parse(data);vds.map(function(d){$('input[name="title"]').val(d.title);$('input[name="image"]').val(d.image);$('input[name="video_url"]').val(d.url);addIt()})}});$("#import_section").empty();toggleImport.status=!1}}
function selectAll(){console.log("here")}
function appendCheckToRow(row){var td=$(document.createElement("td"));var input=$(document.createElement("input"));input.attr("type","checkbox");input.attr("name","selectMe");td.append(input);row.append(td)}
function loadSection(sectionFile){var container=$("#container");container.empty();$.ajax({url:sectionFile,success:function(data){container.append(data)}})}
function clearTable(){console.group("Deleting videos");for(var i=1;i<=videos.nbrRows;++i){if(i in videos){console.log("Deleting "+i+" video");delete videos[i]}}
videos.nbrRows=0;console.log("Done!")
console.groupEnd();$("#pending_table tr[id]").remove()}
function checkVideo(){if(videos.nbrRows==0)
return;for(var i=1;i<=videos.nbrRows;++i){if(i in videos){addToPendingTable(videos[i],i)}}}
function addUsers(){loadSection('./sections/add_user.html')}
function addCoffees(){loadSection('./sections/add_coffee.html')}
function getUsers(){loadSection('./sections/get_users.html');loadSavedVideos()}
function getEmails(){loadSection('./sections/get_emails.html');loadSavedEmails()}
function getCoffees(){loadSection('./sections/get_coffees.html');loadSavedCoffees()}
function getComments(){loadSection('./sections/get_comments.html');loadSavedComments()}
function pendingSection(){loadSection('./sections/pending_videos.html');loadPendingVideos()}
function urlsSection(){loadSection('./sections/urls.html');loadUrls()}
function categSection(){loadSection('./sections/categories.html');loadCatOrStdIntoSection("categories")}
function stdSection(){loadSection('./sections/studios.html');loadCatOrStdIntoSection("studios")}
function meMenu(){$('.ui.sidebar').sidebar('toggle')}