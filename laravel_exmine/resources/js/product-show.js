document.addEventListener('DOMContentLoaded', () => {
    const likeButton = document.getElementById('like-button');
    const likeCount = document.getElementById('like-count');

    if (!likeButton) return;

    likeButton.addEventListener('click', async () => {
        const url = likeButton.dataset.url;
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('お気に入り更新に失敗しました');
            }

            const data = await response.json();

            likeButton.dataset.liked = data.liked ? '1' : '0';
            likeButton.textContent = data.liked ? '♡お気に入り解除' : '♡お気に入り';
            likeCount.textContent = data.like_count;

            likeButton.classList.remove('like-button-liked', 'like-button-unliked');

            if (data.liked) {
                likeButton.classList.add('like-button-liked');
            } else {
                likeButton.classList.add('like-button-unliked');
            }
            
        } catch (error) {
            console.error(error);
            alert('お気に入りの更新に失敗しました');
        }
    });
});