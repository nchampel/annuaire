function getMemberProfile() {
    fetch('../../backend/get-member.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            displayMembers(data);
        })
}

function displayMembers(data) {
    let memberElt = document.getElementById('member');
    memberElt.innerText = "";
            
    let cardElt = document.createElement('div');
    let divElt = document.createElement('div');
    let paraElt = document.createElement('p');
    let imgElt = document.createElement('img');
    
    imgElt.src = data.photo;
    imgElt.alt = 'avatar';
    paraElt.appendChild(imgElt);
    divElt.appendChild(paraElt);

    let infoElt = document.createElement('div');
    infoElt.classList.add('info', 'ml');
    let firstLineElt = document.createElement('span');
    firstLineElt.innerText = data.pseudo + " " + data.prenom + " " + data.nom + " " + data.ville;
    infoElt.appendChild(firstLineElt);
    divElt.appendChild(infoElt);
    let dateElt = document.createElement('span');
    dateElt.classList.add('ml');
    dateElt.innerText = "Membre depuis : " + data.date_adhesion;
    infoElt.appendChild(dateElt);
    cardElt.appendChild(divElt);

    memberElt.appendChild(cardElt);

    let titleElt = document.createElement('h3');
    titleElt.innerText = data.titre;

    memberElt.appendChild(titleElt);

    let descriptionElt = document.createElement('p');
    descriptionElt.innerText = data.description;

    memberElt.appendChild(descriptionElt);

    let interestsElt = document.createElement('h3');
    interestsElt.innerText = "Centres d'intérêt";

    memberElt.appendChild(interestsElt);

    let hobbiesElt = document.createElement('ul');

    fetch('../../backend/get-member-interests.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            for(let i = 0 ; i < data.length ; i ++) {
                let hobbyElt = document.createElement('li');
                hobbyElt.innerText = data[i].nom;
                hobbiesElt.appendChild(hobbyElt);
            }
            memberElt.appendChild(hobbiesElt);
        })
            
}
getMemberProfile();