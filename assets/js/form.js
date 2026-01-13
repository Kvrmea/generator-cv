document.addEventListener('DOMContentLoaded', () => {
    const inLastname = document.getElementById('in-lastname');
    const inFirstname = document.getElementById('in-firstname');
    const inJob = document.getElementById('in-job');
    const outFullname = document.getElementById('out-fullname');
    const outJob = document.getElementById('out-job');

    const inEmail = document.getElementById('in-email');
    const inPhone = document.getElementById('in-phone');
    const inAddress = document.getElementById('in-address');
    const inAbout = document.getElementById('in-about');

    const expList = document.getElementById('experience-list');
    const addBtn = document.getElementById('add-experience');
    const template = document.getElementById('experience-template');

    const eduList = document.getElementById('education-list');
    const addEduBtn = document.getElementById('add-education');
    const eduTemplate = document.getElementById('education-template');

    const skillList = document.getElementById('skill-list');
    const addSkillBtn = document.getElementById('add-skill');
    const skillTemplate = document.getElementById('skill-template');

    const updateHeader = () => {
        outFullname.innerText = `${inLastname.value} ${inFirstname.value}`;
        outJob.innerText = inJob.value;
    }

    const updateExperiences = () => {
        const companies = Array.from(document.getElementsByName('exp_company[]'));
        const titles = Array.from(document.getElementsByName('exp_title[]'));
        const starts = Array.from(document.getElementsByName('exp_start[]'));
        const ends = Array.from(document.getElementsByName('exp_end[]'));
        const descriptions = Array.from(document.getElementsByName('exp_description[]'));

        let html = '<h5 class="text-uppercase text-primary border-bottom border-primary pb-2 mb-4">Parcours Professionnel</h5>';
        if (companies.length > 0) html += '<h3 class="fw-bold mb-3">Expériences professionnelles</h3>';

        companies.forEach((company, i) => {
            const title = titles[i];
            const start = starts[i];
            const end = ends[i];
            const description = descriptions[i];
            if (!(company.value.trim() || title.value.trim() || description.value.trim())) return;

            html += `
                <div class="mb-4">
                    <strong>${title.value}</strong><br>
                    <span class="text-muted">${company.value}</span><br>
                    <small class="text-muted">${start.value || ''} - ${end.value || 'Aujourd’hui'}</small>
                    <p class="mt-2 mb-0">${description.value.replace(/\n/g, '<br>')}</p>
                </div>
            `;
        });
        document.getElementById('preview-exp-section').innerHTML = html;
    }

    function updateEducations() {
        const schools = Array.from(document.getElementsByName('edu_school[]'));
        const degrees = Array.from(document.getElementsByName('edu_degree[]'));
        const starts = Array.from(document.getElementsByName('edu_start[]'));
        const ends = Array.from(document.getElementsByName('edu_end[]'));

        let html = '';
        if (schools.length > 0) html += '<h3 class="fw-bold mb-3">Formations</h3>';

        schools.forEach((school, i) => {
            if (!(school.value.trim() || degrees[i].value.trim())) return;
            html += `
                <div class="mb-4">
                    <strong>${degrees[i].value}</strong><br>
                    <span class="text-muted">${school.value}</span><br>
                    <small class="text-muted">${starts[i].value || ''} - ${ends[i].value || 'Aujourd’hui'}</small>
                </div>
            `;
        });
        document.getElementById('preview-edu-section').innerHTML = html;
    }

    const updateSkills = () => {
        const names = Array.from(document.getElementsByName('skill_name[]'));
        const levels = Array.from(document.getElementsByName('skill_level[]'));
        let html = '<h5 class="text-uppercase border-bottom pb-2 mb-3 mt-4">Compétences</h5>';

        names.forEach((name, i) => {
            if (!name.value) return;
            let width = "0%";
            if (levels[i].value === "Débutant") width = "25%";
            if (levels[i].value === "Intermédiaire") width = "50%";
            if (levels[i].value === "Avancé") width = "75%";
            if (levels[i].value === "Expert") width = "100%";

            html += `
                <div class="mb-3">
                    <small class="d-block mb-1">${name.value}</small>
                    <div class="progress" style="height: 5px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: ${width}"></div>
                    </div>
                </div>
            `;
        });
        document.getElementById('preview-skill-section').innerHTML = html;
    };

    const updateContact = () => {
        let html = '<h5 class="text-uppercase small fw-bold border-bottom pb-1 mb-2 mt-4">Contact</h5>';
        if (inEmail.value) html += `<p class="small mb-1">✉️ ${inEmail.value}</p>`;
        if (inPhone.value) html += `<p class="small mb-1">📞 ${inPhone.value}</p>`;
        if (inAddress.value) html += `<p class="small mb-0">📍 ${inAddress.value}</p>`;
        document.getElementById('preview-contact-section').innerHTML = html;
    };

    const updateAbout = () => {
        let html = '';
        if (inAbout.value) {
            html = `
                <h5 class="text-uppercase fw-bold border-bottom pb-2 mb-3">Profil</h5>
                <p class="text-muted small">${inAbout.value.replace(/\n/g, '<br>')}</p>
            `;
        }
        document.getElementById('preview-about-section').innerHTML = html;
    };

    const updatePreview = () => {
        updateHeader();
        updateContact();
        updateAbout();
        updateExperiences();
        updateEducations();
        updateSkills();
    };

    // Écouteurs pour les champs statiques (Identité, Contact, À propos)
    [inLastname, inFirstname, inJob, inEmail, inPhone, inAddress, inAbout].forEach(input => {
        if(input) input.addEventListener('input', updatePreview);
    });

    addBtn.addEventListener('click', () => {
        const clone = template.content.cloneNode(true);
        clone.querySelectorAll('input, textarea').forEach(input => input.addEventListener('input', updatePreview));
        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.experience-item').remove();
            updatePreview();
        });
        expList.appendChild(clone);
    });

    addEduBtn.addEventListener('click', () => {
        const clone = eduTemplate.content.cloneNode(true);
        clone.querySelectorAll('input, textarea').forEach(el => el.addEventListener('input', updatePreview));
        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.education-item').remove();
            updatePreview();
        });
        eduList.appendChild(clone);
    });

    addSkillBtn.addEventListener('click', () => {
        const clone = skillTemplate.content.cloneNode(true);
        clone.querySelectorAll('input, select').forEach(el => el.addEventListener('input', updatePreview));
        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.skill-item').remove();
            updatePreview();
        });
        skillList.appendChild(clone);
    });

    updatePreview();
});