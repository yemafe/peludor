const breedsData = {
    perro: ["Labrador", "Golden Retriever", "Pastor Alemán", "Bulldog Francés", "Beagle", "Bulldog Inglés", "Chihuahua", "Poodle", "Boxer", "Dachshund", "Schnauzer", "Rottweiler", "Yorkshire Terrier", "Husky Siberiano", "Otro"],
    gato: ["Persa", "Siamés", "Maine Coon", "Bengala", "Sphynx", "British Shorthair", "Ragdoll", "Noruego de Bosque", "Exótico", "Otro"]
};

document.addEventListener("DOMContentLoaded",()=>{
    const type = document.getElementById("petType");
    const breed = document.getElementById("breed");
    const customBreedCont = document.getElementById("custom-breed-container");
    const breedCont = document.getElementById("breed-container");
    const mixed = document.getElementById("mixedBreed");
    const customTypeCont = document.getElementById("custom-type-container");

    type.addEventListener("change",()=>{
        const sel=type.value;
        customTypeCont.classList.toggle("d-none",sel!=="otro");
        breed.innerHTML = `<option disabled selected>Selecciona raza</option>`;
        if(sel==="perro"||sel==="gato"){
            breedsData[sel].forEach(r=>breed.innerHTML+=`<option>${r}</option>`);
        }
        breedCont.classList.toggle("d-none",sel=="otro");
    });
    breed.addEventListener("change",()=>{
        customBreedCont.classList.toggle("d-none",breed.value!=="Otro");
    });
    mixed.addEventListener("change",()=>{
        const lbl=document.querySelector('label[for="breed"]');
        if(mixed.checked&&breed.value&&!customBreedCont.classList.contains("d-none")){
            lbl.textContent=`Cruce de ${breed.value}`;
        } else lbl.textContent="Raza *";
    });

    document.getElementById("photo").addEventListener("change",e=>{
        const f=e.target.files[0];
        if(f&&(!['image/jpeg','image/png','image/webp'].includes(f.type)||f.size>5*1024*1024)){
            alert("Solo JPG/PNG/WEBP y menos de 5 MB.");
            e.target.value="";
        }
    });
});
