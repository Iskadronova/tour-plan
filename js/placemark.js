ymaps.ready(init);

function init() {
  var myMap = new ymaps.Map(
      "ya_map",
      {
        center: [7.574318, 79.803669],
        zoom: 10,
      },
      {
        searchControlProvider: "yandex#search",
      }
    ),
    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject(
      {
        // Описание геометрии.
        geometry: {
          type: "Point",
          coordinates: [7.574318, 79.803669],
        },
        // Свойства.
        // properties: {
        //   // Контент метки.
        //   iconContent: "Я тащусь",
        //   hintContent: "Ну давай уже тащи",
        // },
      },
      {
        // Опции.
        // Иконка метки будет растягиваться под размер ее содержимого.
        preset: "islands#blackStretchyIcon",
        // Метку можно перемещать.
        draggable: true,
      }
    );

  myMap.geoObjects.add(myGeoObject).add(myPieChart);
  // .add(
  //   new ymaps.Placemark(
  //     [55.826479, 37.487208],
  //     {
  //       balloonContent: "цвет <strong>фэйсбука</strong>",
  //     },
  //     {
  //       preset: "islands#governmentCircleIcon",
  //       iconColor: "#3b5998",
  //     }
  // )
  // );
}
