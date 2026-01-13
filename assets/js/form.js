document.addEventListener('DOMContentLoaded', () => {
    // Éléments du formulaire
    const inLastname = document.getElementById('in-lastname');
    const inFirstname = document.getElementById('in-firstname');
    const inJob = document.getElementById('in-job');
    const inEmail = document.getElementById('in-email');
    const inPhone = document.getElementById('in-phone');
    const inAddress = document.getElementById('in-address');
    const inAbout = document.getElementById('in-about');
    const inPhoto = document.getElementById('in-photo');
    const templateChoice = document.getElementById('template-choice');

    // Zones de sortie Preview
    const outFullname = document.getElementById('out-fullname');
    const outJob = document.getElementById('out-job');
    const previewPhoto = document.getElementById('preview-photo');

    // Listes et boutons
    const addExpBtn = document.getElementById('add-experience');
    const addEduBtn = document.getElementById('add-education');
    const addSkillBtn = document.getElementById('add-skill');

    const updatePreview = () => {
        // 1. En-tête
        outFullname.innerText = `${inFirstname.value} ${inLastname.value}`.toUpperCase();
        outJob.innerText = inJob.value;

        // 2. Contact (Sidebar)
        let contactHtml = '<h6 class="text-uppercase border-bottom pb-1 mb-2 mt-4" style="font-size: 0.8rem;">Contact</h6>';
        if (inEmail.value) contactHtml += `<p class="small mb-1">✉️ ${inEmail.value}</p>`;
        if (inPhone.value) contactHtml += `<p class="small mb-1">📞 ${inPhone.value}</p>`;
        if (inAddress.value) contactHtml += `<p class="small mb-0">📍 ${inAddress.value}</p>`;
        document.getElementById('preview-contact-section').innerHTML = contactHtml;

        // 3. À propos (Profil)
        document.getElementById('preview-about-section').innerHTML = inAbout.value ? 
            `<h5 class="text-uppercase border-bottom pb-2 mb-3 fw-bold">Profil</h5><p class="small text-muted">${inAbout.value.replace(/\n/g, '<br>')}</p>` : '';

        // 4. Expériences
        const companies = document.getElementsByName('exp_company[]');
        const titles = document.getElementsByName('exp_title[]');
        const starts = document.getElementsByName('exp_start[]');
        const ends = document.getElementsByName('exp_end[]');
        const descs = document.getElementsByName('exp_description[]');
        
        let expHtml = '<h5 class="text-uppercase border-bottom pb-2 mb-3 fw-bold">Expériences</h5>';
        companies.forEach((comp, i) => {
            if (comp.value || titles[i].value) {
                expHtml += `
                    <div class="mb-3">
                        <div class="d-flex justify-content-between fw-bold"><span>${titles[i].value}</span><small>${starts[i].value} - ${ends[i].value || 'Présent'}</small></div>
                        <div class="text-primary small mb-1">${comp.value}</div>
                        <p class="small text-muted mb-0">${descs[i].value.replace(/\n/g, '<br>')}</p>
                    </div>`;
            }
        });
        document.getElementById('preview-exp-section').innerHTML = expHtml;

        // 5. Formations
        const schools = document.getElementsByName('edu_school[]');
        const degrees = document.getElementsByName('edu_degree[]');
        const eStarts = document.getElementsByName('edu_start[]');
        const eEnds = document.getElementsByName('edu_end[]');

        let eduHtml = '<h5 class="text-uppercase border-bottom pb-2 mb-3 fw-bold">Formations</h5>';
        schools.forEach((sch, i) => {
            if (sch.value || degrees[i].value) {
                eduHtml += `
                    <div class="mb-2">
                        <div class="d-flex justify-content-between fw-bold"><span>${degrees[i].value}</span><small>${eStarts[i].value} - ${eEnds[i].value}</small></div>
                        <div class="small">${sch.value}</div>
                    </div>`;
            }
        });
        document.getElementById('preview-edu-section').innerHTML = eduHtml;

        // 6. Compétences
        const sNames = document.getElementsByName('skill_name[]');
        const sLevels = document.getElementsByName('skill_level[]');
        let skillHtml = '<h6 class="text-uppercase border-bottom pb-1 mb-2 mt-4" style="font-size: 0.8rem;">Compétences</h6>';
        sNames.forEach((name, i) => {
            if (name.value) {
                let w = sLevels[i].value === 'Expert' ? '100%' : (sLevels[i].value === 'Intermédiaire' ? '60%' : '30%');
                skillHtml += `
                    <div class="mb-2">
                        <div class="small mb-1">${name.value}</div>
                        <div class="progress" style="height: 4px;"><div class="progress-bar bg-info" style="width: ${w}"></div></div>
                    </div>`;
            }
        });
        document.getElementById('preview-skill-section').innerHTML = skillHtml;
    };

    // Gestion de la photo
    inPhoto.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewPhoto.style.backgroundImage = `url(${e.target.result})`;
                previewPhoto.classList.remove('bg-secondary');
            }
            reader.readAsDataURL(file);
        }
    });

    // Gestion du changement de template (Visuel Preview)
    templateChoice.addEventListener('change', (e) => {
        const preview = document.getElementById('cv-preview');
        const sidebar = preview.querySelector('.col-4');
        if (e.target.value === 'classic') {
            sidebar.classList.replace('bg-dark', 'bg-light');
            sidebar.classList.replace('text-white', 'text-dark');
        } else {
            sidebar.classList.replace('bg-light', 'bg-dark');
            sidebar.classList.replace('text-dark', 'text-white');
        }
    });

    // Écouteurs globaux
    [inLastname, inFirstname, inJob, inEmail, inPhone, inAddress, inAbout].forEach(el => el.addEventListener('input', updatePreview));

    const setupAdd = (btn, templateId, listId) => {
        btn.addEventListener('click', () => {
            const clone = document.getElementById(templateId).content.cloneNode(true);
            clone.querySelectorAll('input, textarea, select').forEach(el => el.addEventListener('input', updatePreview));
            clone.querySelector('.remove-btn').addEventListener('click', e => { e.target.closest('.card').remove(); updatePreview(); });
            document.getElementById(listId).appendChild(clone);
            updatePreview();
        });
    };

    setupAdd(addExpBtn, 'experience-template', 'experience-list');
    setupAdd(addEduBtn, 'education-template', 'education-list');
    setupAdd(addSkillBtn, 'skill-template', 'skill-list');

    updatePreview();
});