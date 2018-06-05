var news = ""

function getNews() {

  //604800000 milisegundos em uma semana
  url = getSearchTerms()

  let req = new Request(url);

  fetch(req).then(
    response => {
      if (response.status === 200) {
        response.json().then(results=>showNews(results.articles))
      }
    })   
}
function getSearchTerms(){

  let url = "https://newsapi.org/v2/everything?"+
            "q=aeroportos&"+
            `from=${getLastWeekAsISOString()}&` +
            "sources=globo&"+
            "sortBy=popularity&" +
            "apiKey=049520bc362c4cb495123530b22b70fd"

  return url;
}

function getLastWeekAsISOString(){
  let aweekago = new Date((Date.now() - 604800000)).toISOString();
  return aweekago.substring(0,10);
}

function showNews(newsarray){
  newsarray = newsarray.slice(0,8);
  let newsHTML = "";
  count = 0;
  newsarray.forEach(function(news){
    
    if (count >= 11){
      count = 0;
    }
    else if(news.description == "" && count < 8){
      newsHTML += makeSmallNews(news);
      count += 4;
    }
    else if(count < 5){
      newsHTML += makeLargeNews(news);
      count += 7;
    }
    else if(count < 8 ){
      newsHTML += makeMediumNews(news);
      count += 4;
    }
    else{
      newsHTML += makeSmallNews(news);
      count += 4;
    }
  });

  insertNewsIntoPage(newsHTML);
}

function makeLargeNews(news){

  let html_lg = `
    <div class="card col-md-7 col-xs-12">
      <div class="news-lg">

        <h6>${news.title}</h6>
        <hr>
        <p>${news.description}</p>
        <hr>
        <a href='${news.url}'fonte">Fonte: ${news.source.name} </a>
      </div>
    </div>  
  `
  return html_lg;
}

function makeMediumNews(news){

  let html_md = `
    <div class="card col-md-4 col-xs-12">
      <div class="news-md">

        <h6>${news.title}</h6>
        <hr>
        <small>${news.description}</small>
        <hr>
        <a href='${news.url}'fonte">Fonte: ${news.source.name} </a>
      </div>
    </div>  
  `
  return html_md;
}

function makeSmallNews(news){

  let html_sm = `
    <div class="card col-md-4 col-xs-12">
      <div class="news-sm">
        <hr>
        <h5>${news.title}</h5>
        <hr>
        <a href='${news.url}'fonte">Fonte: ${news.source.name} </a>
      </div>
    </div>  
  `
  return html_sm;
}

function insertNewsIntoPage(newsHTML){
  let panel = document.getElementById("newspanel");

  panel.innerHTML = newsHTML;
}

// --------------------------------------------------------------------------------//
function requestContent(){
  let Request =  new XMLHttpRequest();
  Request.open("GET", 'controller.php?task=GETCTT&type=TXT', true);
  Request.send();

  Request.onload = function(){
    fillPageContent(Request.responseText);
  }
}

function fillPageContent(contents){

  console.log(contents);
  contents = JSON.parse(contents);

  fillIntro(contents['introtitle'] + contents['intro']);
  fillHist(contents['historiatitle'] + contents['historia'] + contents['historiasignature']);
}

function fillIntro(contents){
  let intro = document.getElementById("introTXT");
  intro.innerHTML = contents;
}

function fillHist(contents){
  let historiaTXT = document.getElementById("historiaTXT");

  historiaTXT.innerHTML = contents;
}



// --------------------------------------------------------------------------------//
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}

// --------------------------------------------------------------------------------//

document.body.onload = function(){
  requestContent();
  getNews();
} 
