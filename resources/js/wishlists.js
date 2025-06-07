 

        document.addEventListener('DOMContentLoaded', function() {
            const maxSelected = 5;
            let selectedProjects = [];

            const selectedSection = document.querySelectorAll('.col-md-6 .list-group')[0];
            const availableSection = document.querySelectorAll('.col-md-6 .list-group')[1];
            const warning = document.getElementById('max-warning');
            const countSpan = document.getElementById('selected-count');
            const hiddenInput = document.getElementById('selected-projects-input');
            const form = document.getElementById('wishlist-form');

            // Initialize selectedProjects array
            selectedSection.querySelectorAll('.project-checkbox:checked').forEach(cb => {
                selectedProjects.push(parseInt(cb.value));
            });
            updateUI();

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('project-checkbox')) {
                    const checkbox = e.target;
                    const projectId = parseInt(checkbox.value);
                    const label = checkbox.closest('label');

                    if (checkbox.checked) {
                        if (selectedProjects.length < maxSelected && !selectedProjects.includes(
                            projectId)) {
                            selectedProjects.push(projectId);
                            selectedSection.appendChild(label);
                        } else {
                            checkbox.checked = false;
                            warning.classList.remove('d-none');
                        }
                    } else {
                        selectedProjects = selectedProjects.filter(id => id !== projectId);
                        availableSection.appendChild(label);
                    }

                    updateUI();
                }
            });

            form.addEventListener('submit', function() {
                hiddenInput.value = JSON.stringify(selectedProjects);
            });

            function updateUI() {
                countSpan.textContent = `${selectedProjects.length}/${maxSelected}`;
                if (selectedProjects.length < maxSelected) {
                    warning.classList.add('d-none');
                }
            }
        });