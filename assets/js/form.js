document.addEventListener('DOMContentLoaded', () => {
    const inLastname = document.getElementById('in-lastname');
    const inFirstname = document.getElementById('in-firstname');
    const inJob = document.getElementById('in-job');
    const outFullname = document.getElementById('out-fullname');
    const outJob = document.getElementById('out-job');

    const expList = document.getElementById('experience-list');
    const addBtn = document.getElementById('add-experience');
    const template = document.getElementById('experience-template');

    const eduList = document.getElementById('education-list');
    const addEduBtn = document.getElementById('add-education');
    const eduTemplate = document.getElementById('education-template');

    // Info générales
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

        let html = '';

        if (companies.length > 0) {
            html += '<h3 class="fw-bold mb-3">Expériences professionnelles</h3>';
        }

        companies.forEach((company, i) => {
            const title = titles[i];
            const start = starts[i];
            const end = ends[i];
            const description = descriptions[i];

            const hasContent =
                company.value.trim() ||
                title.value.trim() ||
                description.value.trim();

            if (!hasContent) return;

            const startDate = start.value || '';
            const endDate = end.value || 'Aujourd’hui';

            html += `
                <div class="mb-4">
                    <strong>${title.value}</strong><br>
                    <span class="text-muted">${company.value}</span><br>
                    <small class="text-muted">${startDate} - ${endDate}</small>

                    <p class="mt-2 mb-0">
                        ${description.value.replace(/\n/g, '<br>')}
                    </p>
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

    if (schools.length > 0) {
        html += '<h3 class="fw-bold mb-3">Formations</h3>';
    }

    schools.forEach((school, i) => {
        const degree = degrees[i];
        const start = starts[i];
        const end = ends[i];

        const hasContent =
            school.value.trim() ||
            degree.value.trim();

        if (!hasContent) return;

        const startDate = start.value || '';
        const endDate = end.value || 'Aujourd’hui';

        html += `
            <div class="mb-4">
                <strong>${degree.value}</strong><br>
                <span class="text-muted">${school.value}</span><br>
                <small class="text-muted">${startDate} - ${endDate}</small>
            </div>
        `;
    });

    document.getElementById('preview-edu-section').innerHTML = html;
}

    // Fonction de mise à jour de l'aperçu
    const updatePreview = () => {
        updateHeader();
        updateExperiences();
        updateEducations();
    };

    // Gestion du bouton Ajouter une expérience
    addBtn.addEventListener('click', () => {
        const clone = template.content.cloneNode(true);

        // On active la mise à jour en direct pour les nouveaux champs créés
        // Sinon, taper dedans ne fera rien car ils n'ont pas d'écouteurs
        clone.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', updatePreview);
        });

        // Gestion de la suppression
        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.experience-item').remove();
            updatePreview();
        });

        expList.appendChild(clone);
    });

    addEduBtn.addEventListener('click', () => {
        const clone = eduTemplate.content.cloneNode(true);

        clone.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', updatePreview);
        });

        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.education-item').remove();
            updatePreview();
        });

        eduList.appendChild(clone);
    });

    inLastname.addEventListener('input', updatePreview);
    inFirstname.addEventListener('input', updatePreview);
    inJob.addEventListener('input', updatePreview);
});