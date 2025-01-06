document.addEventListener('DOMContentLoaded', () => {
    const spinButton = document.getElementById('spin-button');
    const resultDiv = document.getElementById('roulette-result');

    spinButton.addEventListener('click', async () => {
        resultDiv.innerHTML = '<p>Spinning...</p>';

        try {
            const response = await fetch('/roulette/spin');
            const data = await response.json();

            resultDiv.innerHTML = ''; // Clear results

            const categories = Object.keys(data);
            let currentCategoryIndex = 0;

            // Function to show each restriction one at a time
            const showNextRestriction = () => {
                if (currentCategoryIndex < categories.length) {
                    const category = categories[currentCategoryIndex];
                    const categoryDiv = document.createElement('div');
                    categoryDiv.classList.add('fade-in'); // Add fade-in class
                    categoryDiv.innerHTML = `<strong>${category}:</strong> ${data[category]}`;
                    resultDiv.appendChild(categoryDiv);

                    currentCategoryIndex++;

                    // Show next restriction after a delay
                    setTimeout(showNextRestriction, 2000); // 2-second delay
                }
            };

            // Start showing restrictions
            showNextRestriction();
        } catch (error) {
            resultDiv.innerHTML = '<p>Error spinning the roulette. Please try again later.</p>';
            console.error('Error:', error);
        }
    });
});