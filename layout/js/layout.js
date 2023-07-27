(async () => {
    document.addEventListener('DOMContentLoaded', async function () {
        const news = document.querySelectorAll('.plenta-news-likes');
        if (news.length > 0) {
            const {default: News} = await import('./news');
            const newsObj = new News(news);
            newsObj.init();
        }
    })
})()