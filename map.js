//mapa com leafletjs
var map = L.map(document.getElementById('map'), {
      center: [-5.18, -40.67],
      zoom: 15
      });
var basemap = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          });
var Custompopup = "<div class='popflex'><img src='a.png' class='popimg'><div class='popcol'><div class='poph1'>Ecoponto</div><div class='poptext'>Testando Testando Testando</div></div></div><div class='poph2'>Descrição:</div><div class='poptext'>Testando Testando Testando</div><div class='poph2'>Endereço:</div><div class='poptext'>Rua Crateús, N 56, Bairro: Crateús</div><div class='poph2'>Contato:</div><div class='poptext'>85981818817<br>Instagram: @Ecoponto</div>";     
var customOptions =
    {
    'maxWidth': '400',
    'width': '800',
    'className' : 'popupCustom'
    };

var LeafIcon = L.Icon.extend({
    options: {
        iconSize:     [36, 55],
       iconAnchor:   [20, 70], //22 94
       popupAnchor:  [-3, -15] //76
    }
});

var greenIcon = new LeafIcon({iconUrl: 'marker1.png'});
var greenIcon2 = new LeafIcon({iconUrl: 'marker2.png'});

var ponto1 = L.marker([-5.17661500, -40.67926600], {title: 'ponto1',
icon: greenIcon});

var ponto2 = L.marker([-5.177704, -40.673125], {title: "ponto2", icon: greenIcon});

var ponto3 = L.marker([-5.178686, -40.671336], {title: "ponto3", icon: greenIcon2});

var ponto4 = L.marker([-5.178978, -40.66967], {title: "ponto4", icon: greenIcon2});

var rota1 = L.Routing.control({
  waypoints: [
    L.latLng(-5.177704, -40.673125),
    L.latLng(-5.178686, -40.671336)
  ],
  lineOptions: {
      styles: [{color: '#F7863B', opacity: 1, weight: 10}]
   },
   language: 'pt-BR',
  routeWhileDragging: false
});
var grupo1 = L.layerGroup([ponto1, ponto2]);
var grupo2 = L.layerGroup([ponto3, ponto4]);
var grota1 = L.layerGroup([rota1]);
var tudo = L.layerGroup([grupo1, grupo2]);
var overlayMaps = {
"Tudo": tudo,
"Grupo 1": grupo1,
"Grupo 2": grupo2};
ponto1.bindTooltip("Ecoponto", 
    {
        permanent: true, 
        direction: 'center'
    }
);
ponto2.bindTooltip("Ecoponto2", 
    {
        permanent: true, 
        direction: 'center'
    }
);
ponto3.bindTooltip("Ecoponto3", 
    {
        permanent: true, 
        direction: 'center'
    });
ponto4.bindTooltip("Ecoponto4", 
    {
        permanent: true, 
        direction: 'center'
    });
ponto2.bindPopup(Custompopup, customOptions);
ponto1.bindPopup(Custompopup, customOptions);
ponto3.bindPopup(Custompopup, customOptions);
ponto4.bindPopup(Custompopup, customOptions);
basemap.addTo(map);
map.addLayer(tudo);
    
 map.addControl( new L.Control.Search({
		layer: tudo,
		container: 'jpt',
		initial: false,
		collapsed: false,
		textPlaceholder: 'Pesquisar Local...',
		textCancel: 'Cancelar',
		textErr: 'Local Não Encontrado'

	}) );
    


document.querySelector("input[name=it1]").addEventListener('change', function() {
    if(this.checked) map.addLayer(tudo)
      else map.removeLayer(tudo)
    })
    
document.querySelector("input[name=it2]").addEventListener('change', function() {
    if(this.checked) map.addLayer(grupo1)
      else map.removeLayer(grupo1)
    
    })
   
document.querySelector("input[name=it3]").addEventListener('change', function() {
    if(this.checked) map.addLayer(grupo2)
      else map.removeLayer(grupo2)
    
    })
    
document.querySelector("input[name=it4]").addEventListener('change', function() {
    if(this.checked) rota1.addTo(map);
      else rota1.remove(this)
    
    })
    