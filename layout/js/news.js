import '../scss/news.scss';

export default class News {
    constructor(news)
    {
        this.news = news;
    }

    init()
    {
        this.news.forEach(function (item) {
            if (item.classList.contains('not-liked')) {
                item.addEventListener('click', function () {
                    if (item.classList.contains('not-liked')) {
                        let formData = new FormData();
                        formData.append('newsId', item.getAttribute('data-id'));
                        formData.append('REQUEST_TOKEN', item.querySelector('input[name="REQUEST_TOKEN"]').value);
                        fetch('_plenta/news/like', {
                            method: 'POST',
                            body: formData
                        }).then(r => r.json()).then(r => {
                            item.querySelector('.count').innerText = r.likes;
                            item.classList.remove('not-liked');
                            item.classList.add('liked');
                        });
                    }
                });
            }
        });
    }
}
