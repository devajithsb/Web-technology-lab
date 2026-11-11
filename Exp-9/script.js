$(document).ready(function () {

  const cityInput = document.querySelector('#city-input');
  const searchForm = document.querySelector('#search-form');
  const notice = document.querySelector('#notice');
  const weatherContent = document.querySelector('#weather-content');
  const feedStatus = document.querySelector('#feed-status');
  const statusDot = document.querySelector('.status-dot');

  if (!cityInput || !searchForm || !notice || !weatherContent || !feedStatus || !statusDot) {
    return;
  }

  // -----------------------------
  // Variables
  // -----------------------------

  let locations = [];
  let selectedCity = null;
  let unit = 'C';


  

  const today = new Date();

  const todayDate = document.querySelector('#today-date');

  todayDate.dateTime = today.toISOString().slice(0, 10);

  todayDate.textContent = new Intl.DateTimeFormat('en', {
    weekday: 'long',
    month: 'long',
    day: 'numeric'
  }).format(today);


  // -----------------------------
  // Status Function
  // -----------------------------

  function setStatus(message, state = 'ready') {

    feedStatus.textContent = message;

    statusDot.className = `status-dot ${state}`;

  }


  // -----------------------------
  // Show Notice
  // -----------------------------

  function showNotice(message) {

    notice.textContent = message;

    notice.hidden = false;

  }


  // -----------------------------
  // Populate City Suggestions
  // -----------------------------

  function populateCitySuggestions() {

    const cityOptions =
      document.querySelector('#city-options');

    cityOptions.replaceChildren(
      ...locations.map((location) => {

        const option =
          document.createElement('option');

        option.value = location.city;

        option.label = location.country;

        return option;

      })
    );

  }


  // -----------------------------
  // Temperature Conversion
  // -----------------------------

  function toDisplayTemperature(celsius) {

    if (unit === 'C') {

      return Math.round(celsius);

    }

    return Math.round(
      (celsius * 9 / 5) + 32
    );

  }


  // -----------------------------
  // Render Weather
  // -----------------------------

  function renderWeather(location) {

    const locationName =
      document.querySelector('#location-name');


    // City name
    locationName.replaceChildren(
      document.createTextNode(location.city)
    );


    // Country
    const country =
      document.createElement('span');

    country.className = 'location-pin';

    country.textContent =
      ` · ${location.country}`;

    locationName.append(country);


    // Current condition
    document.querySelector(
      '#condition-summary'
    ).textContent =
      location.current.condition;


    // Weather icon
    document.querySelector(
      '#weather-icon'
    ).textContent =
      location.current.icon;


    // Temperature
    document.querySelector(
      '#current-temperature'
    ).textContent =
      toDisplayTemperature(
        location.current.temperature
      );


    // Temperature unit
    document.querySelector(
      '#current-degree'
    ).textContent =
      `°${unit}`;


    // Feels like
    document.querySelector(
      '#feels-like'
    ).textContent =
      `Feels like ${
        toDisplayTemperature(
          location.current.feelsLike
        )
      }°${unit}`;


    // Humidity
    document.querySelector(
      '#humidity'
    ).textContent =
      `${location.current.humidity}%`;


    // Wind speed
    document.querySelector(
      '#wind-speed'
    ).textContent =
      `${location.current.windSpeed} km/h`;


    // Rainfall
    document.querySelector(
      '#rainfall'
    ).textContent =
      `${location.current.rainfall} mm`;


    // -----------------------------
    // Forecast
    // -----------------------------

    const forecastList =
      document.querySelector('#forecast-list');


    forecastList.replaceChildren(
      ...location.forecast.map((day) => {

        const item =
          document.createElement('article');

        item.className =
          'forecast-day';


        // Day
        const dayName =
          document.createElement('h3');

        dayName.className =
          'forecast-day-name';

        dayName.textContent =
          day.day;


        // Icon
        const icon =
          document.createElement('span');

        icon.className =
          'forecast-icon';

        icon.setAttribute(
          'aria-hidden',
          'true'
        );

        icon.textContent =
          day.icon;


        // Condition
        const condition =
          document.createElement('p');

        condition.className =
          'forecast-condition';

        condition.textContent =
          day.condition;


        // Temperatures
        const temps =
          document.createElement('p');

        temps.className =
          'forecast-temps';


        const high =
          document.createElement('strong');

        high.textContent =
          `${toDisplayTemperature(day.high)}°`;


        const low =
          document.createElement('span');

        low.textContent =
          `${toDisplayTemperature(day.low)}°`;


        temps.append(high, low);


        // Add everything to forecast card
        item.append(
          dayName,
          icon,
          condition,
          temps
        );


        return item;

      })
    );

  }


  // -----------------------------
  // Show Selected City
  // -----------------------------

  function showWeather(city) {

    const normalizedCity = (city || '').trim();

    if (!normalizedCity) {

      showNotice(
        'Please enter a city name.'
      );

      cityInput.setAttribute(
        'aria-invalid',
        'true'
      );

      setStatus(
        'CITY REQUIRED',
        'error'
      );

      return;

    }

    const match =
      locations.find((location) =>
        location.city.toLowerCase() ===
        normalizedCity.toLowerCase()
      );


    if (!match) {

      showNotice(
        'No weather data found for that city. Choose a city from the suggestions.'
      );

      cityInput.setAttribute(
        'aria-invalid',
        'true'
      );

      setStatus(
        'CITY NOT FOUND',
        'error'
      );

      return;

    }


    // Hide error
    notice.hidden = true;

    cityInput.removeAttribute(
      'aria-invalid'
    );


    // Set selected city
    cityInput.value =
      match.city;

    selectedCity =
      match;


    // Display weather
    renderWeather(match);


    // Update status
    setStatus(
      'AJAX JSON DATA LOADED',
      'ready'
    );

  }


  // -----------------------------
  // Search Form
  // -----------------------------

  searchForm.addEventListener(
    'submit',
    function (event) {

      event.preventDefault();

      showWeather(
        cityInput.value
      );

    }
  );


  // -----------------------------
  // Clear Error While Typing
  // -----------------------------

  cityInput.addEventListener(
    'input',
    function () {

      cityInput.removeAttribute(
        'aria-invalid'
      );

    }
  );


  // -----------------------------
  // Temperature Unit Switch
  // -----------------------------

  document
    .querySelectorAll('.unit-button')
    .forEach((button) => {

      button.addEventListener(
        'click',
        function () {

          unit =
            button.dataset.unit;


          document
            .querySelectorAll('.unit-button')
            .forEach((unitButton) => {

              const isActive =
                unitButton === button;


              unitButton.classList.toggle(
                'active',
                isActive
              );


              unitButton.setAttribute(
                'aria-pressed',
                String(isActive)
              );

            });


          // Re-render selected city
          if (selectedCity) {

            renderWeather(
              selectedCity
            );

          }

        }
      );

    });


  // -----------------------------
  // AJAX - Load JSON Data
  // -----------------------------

  function loadWeatherData() {

    setStatus(
      'LOADING WEATHER DATA',
      'ready'
    );

    weatherContent.setAttribute(
      'aria-busy',
      'true'
    );


    $.ajax({

      url: 'weather-data.json',

      type: 'GET',

      dataType: 'json',


      success: function (data) {

        console.log(
          'JSON data received:',
          data
        );


        // Validate JSON
        if (
          !data ||
          !Array.isArray(data.locations) ||
          data.locations.length === 0
        ) {

          throw new Error(
            'Invalid weather data format'
          );

        }


        // Store locations
        locations =
          data.locations;

        if (!locations.length) {
          throw new Error(
            'Weather data contains no cities'
          );
        }


        // Create city suggestions
        populateCitySuggestions();


        // Display default city
        const defaultCity = locations.some((location) => location.city.toLowerCase() === cityInput.value.trim().toLowerCase())
          ? cityInput.value.trim()
          : 'Toronto';

        showWeather(defaultCity);


        // Update status
        setStatus(
          'AJAX JSON DATA LOADED',
          'ready'
        );

      },


      // -------------------------
      // Error
      // -------------------------

      error: function (
        xhr,
        status,
        error
      ) {

        console.error(
          'Weather data loading failed:',
          error
        );


        showNotice(
          'Could not load weather data. Please check that weather-data.json is in the same folder and open the project using a local web server.'
        );


        setStatus(
          'DATA UNAVAILABLE',
          'error'
        );

      },


      complete: function () {

        weatherContent.setAttribute(
          'aria-busy',
          'false'
        );

      }

    });

  }


  loadWeatherData();

});