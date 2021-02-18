let checkboxes = document.querySelectorAll('input[type="checkbox"]');
let tags = document.getElementById("tags");
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener("click", function (e) {
    let id = "tag-" + e.target.value;
    let isTagAdded = false;
    if (!document.getElementById(id)) {
      isTagAdded = true;
      let tag = document.createElement("span");
      let textTag = "";
      switch (e.target.value) {
        case "1":
          textTag = "sport";
          break;
        case "2":
          textTag = "musique";
          break;
        case "3":
          textTag = "jeuxvideos";
          break;
        case "4":
          textTag = "lecture";
          break;
        case "5":
          textTag = "informatique";
          break;
        case "6":
          textTag = "sorties";
          break;
        case "7":
          textTag = "cuisine";
          break;
        case "8":
          textTag = "aviation";
          break;
        case "9":
          textTag = "mecanique";
          break;
        case "10":
          textTag = "licornes";
          break;
        case "11":
          textTag = "joaillerie";
          break;
        case "12":
          textTag = "agriculture";
          break;
        case "13":
          textTag = "cinema";
          break;
        case "14":
          textTag = "politique";
          break;
        case "15":
          textTag = "couture";
          break;
        case "16":
          textTag = "animaux";
          break;
        case "17":
          textTag = "science";
          break;
        case "18":
          textTag = "histoire";
          break;
        case "19":
          textTag = "svt";
          break;
        case "20":
          textTag = "physiquechimie";
          break;
        case "21":
          textTag = "taxidermie";
          break;
        case "22":
          textTag = "philatelie";
          break;
      }
      tag.innerText = "#" + textTag;
      e.target.setAttribute("checked", "checked");
      tag.setAttribute("id", "tag-" + e.target.value);
      tag.classList.add("tag");
      tags.appendChild(tag);
    }
    if (e.target.hasAttribute("checked") && isTagAdded === false) {
      let tagToRemove = document.getElementById(id);
      tags.removeChild(tagToRemove);
    }
  });
}
