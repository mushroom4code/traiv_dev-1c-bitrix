<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Ваш заказ успешно оформлен!");?>
    <div class="content">
        <div class="container">
            <main>
                <div class="prompt">
                    <div class="row">

                        <div class="col x1d1 x1d1--m">
                            <h1 style="text-align:center;">Ваш заказ успешно оформлен!</h1>
							<h2 style="text-align:center;"><br>В ближайшее время с Вами свяжется менеджер для обсуждения заказа</h2>
							<p style="text-align:center;">
							<br>
							Чтобы сделать срочный заказ или задать вопрос:<br><br>
							<a class="btn btn--o" href="/contacts/">Свяжитесь с нами</a>
							<br><br>
							<div style="text-align: center;">
                            <a class="btn btn--o" href="/">Вернуться на главную страницу</a>
							<br><br>
							<a class="btn btn--o" href="/search/">Воспользоваться поиском</a>
							</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>