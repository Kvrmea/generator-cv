document.addEventListener('DOMContentLoaded', () => {
    const inFirstname = document.getElementById('in-firstname');
    const inLastname = document.getElementById('in-lastname');
    const inJob = document.getElementById('in-job');
    const outFullname = document.getElementById('out-fullname');
    const outJob = document.getElementById('out-job');

    const updatePreview = () => {
        outFullname.innerHTML = `${inLastname.value} ${inFirstname.value}`;
        outJob.innerHTML = inJob.value;
    };

    //événement 'input'
    inLastname.addEventListener('input', updatePreview);
    inFirstname.addEventListener('input', updatePreview);
    inJob.addEventListener('input', updatePreview);
});