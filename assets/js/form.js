document.addEventListener('DOMContentLoaded', () => {
    const inLastname = document.getElementById('in-lastname');
    const inFirstname = document.getElementById('in-firstname');
    const inJob = document.getElementById('in-job');
    const outFullname = document.getElementById('out-fullname');
    const outJob = document.getElementById('out-job');

    const expList = document.getElementById('experience-list');
    const addBtn = document.getElementById('add-experience');
    const template = document.getElementById('experience-template');

    // Fonction de mise à jour de l'aperçu
    const updatePreview = () => {
        // 1. Mise à jour des infos de base
        outFullname.innerText = `${inFirstname.value} ${inLastname.value}`;
        outJob.innerText = inJob.value; // <-- IL MANQUAIT CETTE LIGNE pour afficher le métier

        // 2. Mise à jour des expériences
        const companies = document.getElementsByName('exp_company[]');
        const titles = document.getElementsByName('exp_title[]');

        let html = "<h3>Expériences</h3><ul>";
        companies.forEach((company, i) => {
            const title = titles[i];
            // On vérifie si l'un des deux champs est rempli
            if (company.value.trim() !== "" || title.value.trim() !== "") {
                html += `<li><strong>${title.value}</strong> chez ${company.value}</li>`;
            }
        });
        html += "</ul>";

        let previewExp = document.getElementById('preview-exp-section');
        if (!previewExp) {
            previewExp = document.createElement('div');
            previewExp.id = 'preview-exp-section';
            document.getElementById('cv-preview').appendChild(previewExp);
        }
        previewExp.innerHTML = html;
    };

    // Gestion du bouton Ajouter une expérience
    addBtn.addEventListener('click', () => {
        const clone = template.content.cloneNode(true);

        // On active la mise à jour en direct pour les nouveaux champs créés
        // Sinon, taper dedans ne fera rien car ils n'ont pas d'écouteurs
        clone.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });

        // Gestion de la suppression
        clone.querySelector('.remove-btn').addEventListener('click', (e) => {
            e.target.closest('.experience-item').remove();
            updatePreview();
        });

        expList.appendChild(clone);
    });

    inLastname.addEventListener('input', updatePreview);
    inFirstname.addEventListener('input', updatePreview);
    inJob.addEventListener('input', updatePreview);
});