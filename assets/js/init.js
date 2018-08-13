const getById = id => document.getElementById(id);

(function($){
  $(function(){
    $('.sidenav').sidenav();
    $('.parallax').parallax();
  });
})(jQuery);

(function() {
  if(!getById('js-granjas')) {
    return
  }

  const granjas = getById('js-granjas');

  const addGranjaToPage = (granjas, title, temperatura, umidade, luminosidade) => {
    const template = `
      <div class="col s12 m4">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <p class="card-title rem-3" id="js-card-main-title">${title}</p>
            <p class="card-title card-custom-title">
              <i class="far fa-lightbulb yellow-text text-darken-1 rem-2"></i> Luminosidade: ${luminosidade}%
            </p>
            <p class="card-title card-custom-title">
              <i class="fas fa-thermometer-empty deep-orange-text text-darken-2 rem-2"></i> Temperatura: ${temperatura}C
            </p>
            <p class="card-title card-custom-title">
              <i class="fas fa-tint light-blue-text text-darken-1 rem-2"></i> Umidade: ${umidade}%
            </p>
          </div>
        </div>
      </div>
    `;
    granjas.innerHTML = template;
  }

  setInterval(() => {
      fetch("http://127.0.0.1/edsa-projeto-nodemcu?controller=granja&action=getGranjaLastInfo")
      .then(res => res.json())
      .then(data => {
        console.log(data);
        addGranjaToPage(
          granjas,
          "Granja 1",
          data.luminosidade.luminosidade,
          data.temperatura.temperatura,
          data.umidade.umidade
        )
      })
      .catch(err => console.log(err))
    }, 5000);
})();