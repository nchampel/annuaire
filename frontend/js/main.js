let checkboxes = document.querySelectorAll('input[type="checkbox"]');
let tags = document.getElementById('tags');
console.log(checkboxes);
for (let i = 0 ; i < checkboxes.length ; i++) {
    checkboxes[i].addEventListener('click', function(e) {
        let id = 'tag-' + e.target.value;
        let isTagAdded = false;
        if(!document.getElementById(id)) {
            isTagAdded = true;
            let tag = document.createElement('span');
            tag.innerText = '#' + e.target.value;
            e.target.setAttribute('checked', 'checked');
            tag.setAttribute('id', 'tag-' + e.target.value);
            tag.classList.add('tag');
            tags.appendChild(tag);
        }
        if(e.target.hasAttribute('checked') && isTagAdded === false){
            
            let tagToRemove = document.getElementById(id);
            tags.removeChild(tagToRemove);
        }
        
    })
}
