const breedsData = {
    perro: ["Labrador", "Golden Retriever", "Pastor Alemán", "Bulldog Francés", "Beagle", "Bulldog Inglés", "Chihuahua", "Poodle", "Boxer", "Dachshund", "Schnauzer", "Rottweiler", "Yorkshire Terrier", "Husky Siberiano", "Otro"],
    gato: ["Persa", "Siamés", "Maine Coon", "Bengala", "Sphynx", "British Shorthair", "Ragdoll", "Noruego de Bosque", "Exótico", "Otro"]
};

const citiesByCountry = {
    España: ["Madrid","Barcelona","Valencia","Sevilla","Zaragoza","Málaga","Murcia","Palma","Bilbao","Alicante"],
    México: ["CDMX","Guadalajara","Monterrey","Puebla","Tijuana","Mérida","Cancún","Querétaro","Chihuahua","Oaxaca"],
    Colombia: ["Bogotá","Medellín","Cali","Barranquilla","Cartagena","Cúcuta","Bucaramanga","Pereira","Santa Marta","Manizales"]
};

document.addEventListener("DOMContentLoaded",()=>{
    const type = document.getElementById("type");
    const breed = document.getElementById("breed");
    const customBreedCont = document.getElementById("custom-breed-container");
    const mixed = document.getElementById("mixedBreed");
    const country = document.getElementById("country");
    const city = document.getElementById("city");
    const customTypeCont = document.getElementById("custom-type-container");

    // Pueblos
    Object.keys(citiesByCountry).forEach(c=>{
        country.innerHTML += `<option>${c}</option>`;
    });
    country.addEventListener("change",()=>{
        city.innerHTML = `<option disabled selected>Selecciona ciudad</option>`;
        (citiesByCountry[country.value]||[]).forEach(ci=>{
            city.innerHTML += `<option>${ci}</option>`;
        });
    });

    // Raza y tipo
    type.addEventListener("change",()=>{
        const sel=type.value;
        customTypeCont.classList.toggle("d-none",sel!=="otro");
        breed.innerHTML = `<option disabled selected>Selecciona raza</option>`;
        if(sel==="perro"||sel==="gato"){
            breedsData[sel].forEach(r=>breed.innerHTML+=`<option>${r}</option>`);
        }
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

    // Foto validación
    document.getElementById("photo").addEventListener("change",e=>{
        const f=e.target.files[0];
        if(f&&(!['image/jpeg','image/png','image/webp'].includes(f.type)||f.size>5*1024*1024)){
            alert("Solo JPG/PNG/WEBP y menos de 5 MB.");
            e.target.value="";
        }
    });
});
