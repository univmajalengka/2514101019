// Data foto & deskripsi detail untuk tiap Obyek Wisata
const wisataData = {
    arena: {
        title: "Arena Berkuda Utama Cikebo",
        desc: "Nikmati pengalaman menunggangi kuda pilihan terlatih di lintasan rumput luas seluas 2 hektar. Dikelilingi pemandangan bukit dan hawa sejuk khas Cikebo Majalengka.",
        photos: [
            "https://awsimages.detik.net.id/community/media/visual/2022/09/04/berkuda-ala-koboi-di-istana-stable-majalengka_169.jpeg?w=1200",
            "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgVQLmotLcPHufmw2CxKWpufTv5X0hZmOH-CkiabHeheQXSHC672Qhm4mAa4c0j8WBRhX-OZP_2thtqSBZ1QcOEduE0-Y5spzPYY8agbxUICBSZ67CIgjCFB_6cT8XIzcoSvtPXpyTCWtM97u_64N5UovkCkltpz3RxdVTj0fFeQN49qwY1n_G2RkYrXw/s720/WhatsApp%20Image%202022-09-09%20at%2013.12.26%20(1).jpeg",
        ]
    },
    edukasi: {
        title: "Taman Edukasi Satwa & Kuda Poni",
        desc: "Wahana favorit bagi anak-anak untuk mengenal hewan lebih dekat. Anak-anak diperbolehkan menyapa, memandikan, serta memberikan pakan organik secara langsung.",
        photos: [
            "stw1 (1).jpeg",
            "stw1 (2).jpeg",
            "stw1 (3).jpeg",
            "stw1 (4).jpeg",
            "stw1 (5).jpeg",
            "stw1 (6).jpeg",
            "stw1 (7).jpeg",
            "stw1 (8).jpeg",
            "stw1 (9).jpeg",
            "stw1 (10).jpeg",
            "stw1 (11).jpeg"
        ]
    },
    spotfoto: {
        title: "Spot Foto Aesthetic & Tugu Istana Stable",
        desc: "Area terbuka dengan ikon Tugu Istana Stable Equestrian Park dan panorama indah pegunungan Ciremai. Sangat cocok untuk foto keluarga, konten Instagram, hingga foto Prewedding.",
        photos: [
            "poto (1).jpeg",
            "poto (2).jpeg",
            "poto (3).jpeg",
            "poto (4).jpeg",
            "poto (5).jpeg",
            "poto (6).jpeg",
            "poto (7).jpeg"
        ]
    }
};

// Fungsi membuka popup modal Obyek Wisata
function openWisataModal(type) {
    const data = wisataData[type];
    if (!data) return;

    document.getElementById('modalTitle').innerText = data.title;
    document.getElementById('modalDesc').innerText = data.desc;

    const photoGrid = document.getElementById('modalPhotoGrid');
    photoGrid.innerHTML = '';

    data.photos.forEach(src => {
        const img = document.createElement('img');
        img.src = src;
        img.alt = data.title;
        photoGrid.appendChild(img);
    });

    document.getElementById('wisataModal').style.display = 'flex';
}

// Fungsi menutup popup modal Obyek Wisata
function closeWisataModal() {
    document.getElementById('wisataModal').style.display = 'none';
}

// Fitur Lightbox Galeri Foto
function openLightbox(element) {
    const img = element.querySelector('img');
    if (!img) return;
    document.getElementById('lightbox-img').src = img.src;
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}

// Smooth Scroll Navigasi Active State
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id], header[id], main[id], footer[id]');
    const navLinks = document.querySelectorAll('.nav-menu a');

    let current = '';

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 120) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});