/*!
* Start Bootstrap - Blog Home v5.0.9 (https://startbootstrap.com/template/blog-home)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-blog-home/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project


document.getElementById('searchInput').addEventListener('input', function () {
    const searchTerm = this.value.trim();

    fetch(`http://events.test:8080/wp-json/events/v1/search?search=${searchTerm}`)
        .then(response => response.json())
        .then(data => {
            displayEvents(data);
        })
        .catch(error => console.error('Error fetching events:', error));

});

function displayEvents(events) {
    const resultsContainer = document.getElementById('eventsResults');
    resultsContainer.innerHTML = ''; // Clear previous results

    if (events.data.length > 0) {
        events.data.forEach(event => {
            const eventCard = `
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <a href="#">
                            <img class="card-img-top" src="${event.image}" alt="${event.title}" />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">${event.event_date}</div>
                            <h2 class="card-title h4">${event.title}</h2>
                            <p class="card-text">${event.description}</p>
                            <a class="btn btn-primary" href="#">Read more →</a>
                        </div>
                    </div>
                </div>
            `;
            resultsContainer.innerHTML += eventCard;
        });
    } else {
        resultsContainer.innerHTML = '<p class="text-center">No events found!</p>';
    }
}
