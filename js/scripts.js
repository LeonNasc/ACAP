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
            "q=(aeroportos+OR+Santos+Dumont+OR+Galeão)+AND+Brasil&"+
            `from=${getLastWeekAsISOString()}` +
            "sources=globo"+
            "language=pt+OR+en"+
            "pageSize=4"+
            "sortBy=relevancy&" +
            "apiKey=049520bc362c4cb495123530b22b70fd"

  return url;
}

function getLastWeekAsISOString(){
  let aweekago = new Date((Date.now() - 604800000)).toISOString();
  return aweekago.substring(0,10);
}

function showNews(newsarray){
  let newsHTML = "";
  console.log(news);
  count = 0;
  newsarray.forEach(function(news){
    console.log(news)
    count++;
    
    if (count > 4){
      //Faz nada;
    }
    else if(count%3 == 1){
      newsHTML += makeLargeNews(news);
    }
    else if(count%3 == 0){
      newsHTML += makeMediumNews(news);
    }
    else{
      newsHTML += makeSmallNews(news);
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

window.onload = getNews();


function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}