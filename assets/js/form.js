document.addEventListener('DOMContentLoaded', () => {
    // Éléments du formulaire
    const form          = document.getElementById('cv-form');
    const inLastname    = document.getElementById('in-lastname');
    const inFirstname   = document.getElementById('in-firstname');
    const inJob         = document.getElementById('in-job');
    const inEmail       = document.getElementById('in-email');
    const inPhone       = document.getElementById('in-phone');
    const inAddress     = document.getElementById('in-address');
    const inAbout       = document.getElementById('in-about');
    const inPhoto       = document.getElementById('in-photo');
    const inMainColor   = document.getElementById('main-color');
    const fontChoice    = document.getElementById('font-choice');
    const templateChoice = document.getElementById('template-choice');

    // Zones de sortie Preview
    const cvPreview     = document.getElementById('cv-preview');
    const outFullname   = document.getElementById('out-fullname');
    const outJob        = document.getElementById('out-job');
    const previewPhoto  = document.getElementById('preview-photo');

    // Boutons d'ajout
    const addExpBtn     = document.getElementById('add-experience');
    const addEduBtn     = document.getElementById('add-education');
    const addSkillBtn   = document.getElementById('add-skill');

    const updatePreview = () => {
        // DESIGN (Couleur, Police & Template)
        cvPreview.style.setProperty('--main-color', inMainColor.value);
        cvPreview.style.fontFamily = fontChoice.value;

        // Gestion du basculement Modern / Classic
        if (templateChoice.value === 'classic') {
            cvPreview.classList.add('template-classic');
        } else {
            cvPreview.classList.remove('template-classic');
        }

        // EN-TÊTE
        outFullname.innerText = `${inFirstname.value} ${inLastname.value}`.toUpperCase() || 'PRÉNOM NOM';
        outJob.innerText = inJob.value || 'TITRE DU POSTE';

        // CONTACT
        document.getElementById('out-email').innerText   = inEmail.value || 'email@exemple.com';
        document.getElementById('out-phone').innerText   = inPhone.value || '06 00 00 00 00';
        document.getElementById('out-address').innerText = inAddress.value || 'Ville, Pays';

        // À PROPOS
        const aboutContent = document.getElementById('preview-about-section');
        aboutContent.innerHTML = inAbout.value ? 
            `<div class="section-title">Profil</div><div class="item-desc">${inAbout.value.replace(/\n/g, '<br>')}</div>` : '';

        // EXPÉRIENCES
        const companies = document.getElementsByName('exp_company[]');
        const titles    = document.getElementsByName('exp_title[]');
        const starts    = document.getElementsByName('exp_start[]');
        const ends      = document.getElementsByName('exp_end[]');
        const descs     = document.getElementsByName('exp_description[]');
        
        let expHtml = '';
        let hasExp = false;
        companies.forEach((comp, i) => {
            if (comp.value || titles[i].value) {
                hasExp = true;
                expHtml += `
                    <div class="item">
                        <span class="item-date">${starts[i].value} - ${ends[i].value || 'Présent'}</span>
                        <div class="item-header">${titles[i].value}</div>
                        <div class="item-sub">${comp.value}</div>
                        <div class="item-desc">${descs[i].value.replace(/\n/g, '<br>')}</div>
                    </div>`;
            }
        });
        document.getElementById('preview-exp-section').innerHTML = hasExp ? `<div class="section-title">Expériences</div>${expHtml}` : '';

        // FORMATIONS
        const schools = document.getElementsByName('edu_school[]');
        const degrees = document.getElementsByName('edu_degree[]');
        const eStarts = document.getElementsByName('edu_start[]');
        const eEnds   = document.getElementsByName('edu_end[]');

        let eduHtml = '';
        let hasEdu = false;
        schools.forEach((sch, i) => {
            if (sch.value || degrees[i].value) {
                hasEdu = true;
                eduHtml += `
                    <div class="item">
                        <span class="item-date">${eStarts[i].value} - ${eEnds[i].value}</span>
                        <div class="item-header">${degrees[i].value}</div>
                        <div class="item-sub">${sch.value}</div>
                    </div>`;
            }
        });
        document.getElementById('preview-edu-section').innerHTML = hasEdu ? `<div class="section-title">Formations</div>${eduHtml}` : '';

        // COMPÉTENCES
        const sNames  = document.getElementsByName('skill_name[]');
        const sLevels = document.getElementsByName('skill_level[]');
        let skillHtml = '';
        let hasSkills = false;
        sNames.forEach((name, i) => {
            if (name.value) {
                hasSkills = true;
                let w = sLevels[i].value === 'Expert' ? '100%' : (sLevels[i].value === 'Intermédiaire' ? '60%' : '30%');
                skillHtml += `
                    <div class="skill-item">
                        <div class="skill-name">${name.value}</div>
                        <div class="progress-bg"><div class="progress-bar" style="width: ${w}; background-color: var(--main-color)"></div></div>
                    </div>`;
            }
        });
        document.getElementById('preview-skill-section').innerHTML = hasSkills ? `<div class="contact-title">Compétences</div>${skillHtml}` : '';
    };

    // GESTION DES ÉVÉNEMENTS

    // Photo de profil
    inPhoto.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewPhoto.style.backgroundImage = `url(${e.target.result})`;
                previewPhoto.style.backgroundSize = "cover";
                previewPhoto.style.backgroundPosition = "center";
            };
            reader.readAsDataURL(file);
        }
    });

    // Écouteurs sur tous les champs de base pour mise à jour immédiate
    [inLastname, inFirstname, inJob, inEmail, inPhone, inAddress, inAbout, inMainColor, fontChoice, templateChoice].forEach(el => {
        el.addEventListener('input', updatePreview);
    });

    // Ajout de champs dynamiques (Exp, Edu, Skills)
    const setupAdd = (btn, templateId, listId) => {
        btn.addEventListener('click', () => {
            const clone = document.getElementById(templateId).content.cloneNode(true);
            clone.querySelectorAll('input, textarea, select').forEach(el => el.addEventListener('input', updatePreview));
            clone.querySelector('.remove-btn').addEventListener('click', e => { 
                e.target.closest('.card').remove();
                updatePreview(); 
            });
            document.getElementById(listId).appendChild(clone);
            updatePreview();
        });
    };

    setupAdd(addExpBtn, 'experience-template', 'experience-list');
    setupAdd(addEduBtn, 'education-template', 'education-list');
    setupAdd(addSkillBtn, 'skill-template', 'skill-list');

    // GESTION D'ERREURS (Validation avant envoi)
    form.addEventListener('submit', (e) => {
        let errors = [];
        if (!inFirstname.value.trim()) errors.push("Le prénom est obligatoire.");
        if (!inLastname.value.trim()) errors.push("Le nom est obligatoire.");
        if (!inEmail.value.trim()) errors.push("L'adresse email est obligatoire.");
        
        if (errors.length > 0) {
            e.preventDefault(); // Bloque l'envoi
            alert("Attention :\n- " + errors.join("\n- "));
        }
    });

    // Initialisation au chargement
    updatePreview();
});