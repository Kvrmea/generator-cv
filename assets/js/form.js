document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cv-form');
    
    // Fonction principale de mise à jour
    const updatePreview = () => {
        const template = document.getElementById('template-choice').value;
        const mainColor = document.getElementById('main-color').value;
        const container = document.querySelector('.cv-container');
        const sidebar = document.querySelector('.cv-sidebar');
        
        // 1. Gestion des thèmes et couleurs
        document.documentElement.style.setProperty('--main-color', mainColor);
        if(template === 'classic') {
            container.classList.add('rtl-container');
            sidebar.style.backgroundColor = mainColor;
        } else {
            container.classList.remove('rtl-container');
            sidebar.style.backgroundColor = '#2c3e50';
        }

        // 2. Infos Personnelles
        document.getElementById('out-fullname').innerText = (document.getElementById('in-firstname').value + ' ' + document.getElementById('in-lastname').value).toUpperCase() || 'PRÉNOM NOM';
        document.getElementById('out-job').innerText = document.getElementById('in-job').value || 'TITRE DU POSTE';
        document.getElementById('out-email-text').innerText = document.getElementById('in-email').value || 'email@exemple.com';
        document.getElementById('out-phone-text').innerText = document.getElementById('in-phone').value || '';
        document.getElementById('out-address-text').innerText = document.getElementById('in-address').value || '';

        // 3. À propos
        const aboutValue = document.getElementById('in-about').value;
        const aboutSection = document.getElementById('preview-about-section');
        if(aboutValue) {
            aboutSection.innerHTML = `<div class="section-title">Profil</div><p style="font-size:10pt; line-height:1.4;">${aboutValue.replace(/\n/g, '<br>')}</p>`;
        } else {
            aboutSection.innerHTML = '';
        }

        // 4. Expériences Professionnelles
        renderDynamicSection('exp_company[]', 'exp_title[]', 'exp_start[]', 'exp_end[]', 'exp_description[]', 'preview-exp-section', 'Expériences Professionnelles');

        // 5. Formations
        renderEducationSection('preview-edu-section');

        // 6. Compétences (Sidebar)
        renderSkillsSection();
    };

    // Fonction pour les Expériences
    function renderDynamicSection(compName, titleName, startName, endName, descName, targetId, sectionTitle) {
        const companies = document.getElementsByName(compName);
        const titles = document.getElementsByName(titleName);
        const starts = document.getElementsByName(startName);
        const ends = document.getElementsByName(endName);
        const descs = document.getElementsByName(descName);
        
        let html = '';
        companies.forEach((el, i) => {
            if (el.value) {
                html += `
                <div class="item-box">
                    <div class="item-title">${titles[i].value || 'Poste'}</div>
                    <div class="item-sub">${el.value}</div>
                    <div class="item-date">${starts[i].value} - ${ends[i].value || 'Présent'}</div>
                    <div style="font-size:10pt;">${descs[i].value.replace(/\n/g, '<br>')}</div>
                </div>`;
            }
        });
        document.getElementById(targetId).innerHTML = html ? `<div class="section-title">${sectionTitle}</div>${html}` : '';
    }

    // Fonction pour les Formations
    function renderEducationSection(targetId) {
        const schools = document.getElementsByName('edu_school[]');
        const degrees = document.getElementsByName('edu_degree[]');
        const starts = document.getElementsByName('edu_start[]');
        const ends = document.getElementsByName('edu_end[]');
        
        let html = '';
        schools.forEach((el, i) => {
            if (el.value) {
                html += `
                <div class="item-box">
                    <div class="item-title">${degrees[i].value || 'Diplôme'}</div>
                    <div class="item-sub">${el.value}</div>
                    <div class="item-date">${starts[i].value} - ${ends[i].value}</div>
                </div>`;
            }
        });
        document.getElementById(targetId).innerHTML = html ? `<div class="section-title">Formation</div>${html}` : '';
    }

    // Fonction pour les Compétences (Sidebar)
    function renderSkillsSection() {
        const names = document.getElementsByName('skill_name[]');
        const levels = document.getElementsByName('skill_level[]');
        let html = '';
        names.forEach((el, i) => {
            if (el.value) {
                let width = levels[i].value === 'Expert' ? '100%' : (levels[i].value === 'Intermédiaire' ? '60%' : '30%');
                html += `
                <div class="skill-item">
                    <div style="font-size:9pt;">${el.value}</div>
                    <div class="skill-bar-bg"><div class="skill-bar-fill" style="width:${width};"></div></div>
                </div>`;
            }
        });
        document.getElementById('preview-skill-section').innerHTML = html ? `<div class="section-title sidebar-title">Compétences</div>${html}` : '';
    }

    // Écouteurs d'événements
    form.addEventListener('input', updatePreview);

    // Gestion de l'ajout dynamique (Boutons +)
    document.querySelectorAll('.btn-add').forEach(btn => {
        btn.addEventListener('click', () => {
            const templateId = btn.getAttribute('data-template');
            const listId = btn.getAttribute('data-list');
            const template = document.getElementById(templateId);
            const clone = template.content.cloneNode(true);
            document.getElementById(listId).appendChild(clone);
            updatePreview();
        });
    });

    // Suppression (Délégation d'événement)
    form.addEventListener('click', (e) => {
        if (e.target.closest('.remove-btn')) {
            e.target.closest('.card').remove();
            updatePreview();
        }
    });

    // Photo
    document.getElementById('in-photo').addEventListener('change', function() {
        const reader = new FileReader();
        reader.onload = (e) => { 
            document.querySelector('.photo-placeholder').style.backgroundImage = `url(${e.target.result})`; 
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Initialisation
    updatePreview();
});