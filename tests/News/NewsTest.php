<?php

namespace App\Tests\News;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsTest extends WebTestCase
{
    private array $trueCredentials = ['username' => 'rina', 'password' => 'QqQ123'];
    private array $falseCredentials = ['username' => 'username', 'password' => 'password'];

    public function testHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('News index');
        $this->assertCount(9, $crawler->filter('.container-fluid'));
        $link = $crawler->selectLink('Команда ЛГТУ — обладатель Кубка СФФ «Центр» по мини-футболу')->link();
        $client->click($link);
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('News');
    }
    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Вход')->link();
        $client->click($link);
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Авторизация');
        $client->submitForm('Авторизоваться', $this->falseCredentials);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert.alert-danger', 'Invalid credentials.');
        $client->submitForm('Авторизоваться', $this->trueCredentials);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertPageTitleContains('News');
    }
    public function testAddNew()
    {
        $client = static::createClient();
        $client->request('GET', '/new');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $client->submitForm('Войти', $this->trueCredentials );
        $this->assertResponseRedirects();
        $client->followRedirect();
        $new_false = [
            'add_news[title]' => ' ',
            'add_news[annotation]' => ' ',
            'add_news[news_text]' => ' ',
            'add_news[photo]' => ' ',
        ];
        $client->submitForm('Сохранить', $new_false);
        $this->assertSelectorTextContains('.error', 'Пожалуйста введите название новости');
        $new_true = [
            'add_news[title]' => 'Политеховцы – четырехкратные чемпионы «Case-in»',
            'add_news[annotation]' => 'Команда «Time of metal» выиграла юбилейный Х Международный инженерный чемпионат «Case-in» в направлении «Металлургия».',
            'add_news[news_text]' => 'Команда «Time of metal» выиграла юбилейный Х Международный инженерный чемпионат «Case-in» в направлении «Металлургия».

ЛГТУ представляли Владислав Юров, Никита Горюнов, Тарас Скорин и Богдан Дейнека. Все ребята учатся на разных направлениях и выполняли в команде разные роли. Владислав – капитан, металловед и бронзовый призер чемпионата прошлого года. Никита выступал в качестве технолога, он учится на металловеда. IT-специалистом был Тарас. Он учится на направлении «Механика и математическое моделирование». В этом году ребята окончат бакалавриат.  Звание экономиста подтвердил Богдан, второкурсник по направлению «Экономика предприятий и организаций».

Участники разрабатывали комплекс мероприятий индустрии 4.0 для модернизации технологического производства алюминия, что должно было снизить добавленную стоимость продукта. Решение комплексной задачи касалось различных процессов: прогнозирования и оптимизации, повышения срока службы нагревательных элементов, внедрения различных датчиков контроля температур и процессов, интернета-вещей и экспресс-анализа. Каждая задача предполагала высокотехнологичное решение, которое было бы экономичным, экологичным и энергоэффективным.

— Мы предложили внедрить технологии индустрии 4.0: модернизировать имеющиеся автоматизированные системы управления технологическим процессом технологиями машинного обучения, промышленным интернетом-вещей, Big-Data, облачными вычислениями и блокчейном, — рассказал Владислава Юров. — Для предотвращения выхода из строя футеровки можно использовать футеровочный материал – наноксилен. И модернизировать электрический миксер с внедрением нагревательных элементов в свод с защитой из огнеупорного бетона.

     

В финале ребята боролись за победу с командами из 6 российских вузов: Магнитогорского государственного технического университета им. Г.И. Носова, Белорусско-Российского университета, Северо-Кавказского горно-металлургического института, Южно-Уральского государственного университета, Сибирского федерального университета, Саратовского государственного университета им. Ю.А. Гагарина, Сибирского государственного индустриального университета.

Отметим, что за шесть лет участия в «Case-in» политеховцы стали чемпионами в четвертый раз и дважды были призерами.

Поздравляем! Так держать!',
            'add_news[photo]' => 'https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=588&h=392&f=png&src=%2Fassets%2Fgallery%2F2656%2F6214.jpg',
        ];
        $client->submitForm('Сохранить', $new_true);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertPageTitleContains('News');
    }
}
