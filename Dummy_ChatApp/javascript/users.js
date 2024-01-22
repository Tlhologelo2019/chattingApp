const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;

  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }

  // Ajax
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{

    if(xhr.readyState === XMLHttpRequest.DONE){

        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
  // Ajax
  let xhr = new XMLHttpRequest(); //creating XML object
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){

        if(xhr.status === 200){
          let data = xhr.response;

          if(!searchBar.classList.contains("active")){ //if active not contains in serch bar then add theis data
            usersList.innerHTML = data;
          }
        }
    }
  }
  xhr.send();
}, 500); //this function will run frequently after 500ms

//   A function for greeting 

let container = document.querySelector(".container");
let timeNow = new Date().getHours();
console.log(timeNow);

 let greeting = 
    timeNow >= 5 && timeNow < 12 
        ? "Good Morning" 
        : timeNow >= 12 && timeNow < 18 
        ? "Good Afternoon"
        : "Good evening";

container.innerHTML = `<h1>${greeting}</h1>`;