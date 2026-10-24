🌪️ TabStorm

A small PHP-based redirect randomizer and browser behavior demonstration.

TabStorm is an experimental web project built with PHP, HTML, and JavaScript. It demonstrates configurable URL redirection, probability-based routing, and basic browser behavior.

The project is intended for educational purposes, local testing, and controlled demonstrations.

🇬🇧 English | 🇵🇱 "Polski version below" (#wersja-polska)

---

📋 Table of Contents

- "Features" (#-features)
- "Requirements" (#-requirements)
- "Installation" (#-installation)
- "Configuration" (#-configuration)
- "How It Works" (#-how-it-works)
- "Browser Stress Testing" (#-browser-stress-testing)
- "Troubleshooting" (#-troubleshooting)
- "Security and Responsible Use" (#-security-and-responsible-use)
- "License" (#-license)
- "Wersja polska" (#wersja-polska)

---

✨ Features

- Randomized redirection: Select a destination according to configurable probabilities.
- Text-based configuration: Change redirect rules without modifying the PHP script.
- Multiple destinations: Configure local pages and external websites.
- Always-open rules: Use the "+" operator for destinations that should always be included.
- Decimal probabilities: Specify values such as "94.5%" or "0.5%".
- PHP-based processing: Read configuration files on the server.
- Browser demonstrations: Explore how opening additional tabs affects browser behavior.
- Simple deployment: Designed to work with a standard PHP web server.

💻 Requirements

You need:

- A web server with PHP support.
- PHP 8.0 or newer recommended.
- A modern web browser with JavaScript enabled.
- Access to the project's files.

A local PHP development server can be used for testing.

📦 Installation

1. Download or clone this repository.
2. Upload the project files to a PHP-enabled web server.
3. Place "index.php" and "functions1.txt" in the same directory.
4. Make sure the server can read "functions1.txt".
5. Open the corresponding page in your browser.

Important: PHP files must be processed by a PHP server. Opening them directly from your computer as "file://" URLs will not execute the PHP code.

⚙️ Configuration

The redirect rules are stored in "functions1.txt".

Example:

file:/index1.php/ | 95%
https://example.com/ | 4%
https://example.org/ | 1%

Each line contains a destination and a rule value, separated by "|".

Probability rules

A percentage indicates the relative weight of a destination.

For example:

file:/index1.php/ | 95%
https://example.com/ | 4%
https://example.org/ | 1%

When the percentages total 100%, the intended distribution is:

Destination| Probability
"index1.php"| 95%
"example.com"| 4%
"example.org"| 1%

These are probabilities, not guarantees. Actual results will vary over repeated visits.

If the values do not total 100%, the current implementation treats them as relative weights rather than automatically correcting them to total 100%.

Decimal values

Decimal probabilities are supported:

file:/index1.php/ | 94.5%
https://example.com/ | 4.5%
https://example.org/ | 1%

Always-open rules

The "+" operator marks a destination as always included:

file:/index1.php/ | +
https://example.com/ | +

The current implementation attempts to open both destinations.

Browser limitation: Browsers may block multiple new tabs opened automatically by JavaScript. The "+" operator does not override popup-blocking protections.

Zero-percent rules

A rule with "0%" has no chance of being selected by the current implementation.

Example:

https://example.net/ | 0%

This can be useful for temporarily disabling a destination without deleting its configuration line.

🔍 How It Works

The project has two main components.

"index.php"

The PHP script:

1. Reads "functions1.txt".
2. Parses the configured destinations.
3. Separates always-open rules from probability-based rules.
4. Selects a weighted destination.
5. Passes the resulting URLs to JavaScript.
6. Attempts to open the selected destinations in new browser tabs.

"functions1.txt"

This file stores the redirect configuration.

Keeping the configuration separate from the PHP code makes it easier to adjust the destinations and their probabilities.

Example workflow

A visitor opens the entry page.

The server reads the configuration and chooses a destination.

The browser receives the page containing the JavaScript responsible for opening the selected URL.

The browser may open the destination in another tab, depending on its security settings.

🧪 Browser Stress Testing

TabStorm may also be used as a starting point for studying browser performance.

Opening additional tabs can increase memory consumption, CPU usage, network activity, and rendering overhead.

The impact depends on several factors:

- Available system memory.
- Browser implementation and settings.
- The content loaded by each tab.
- Extensions running in the browser.
- Hardware capabilities.
- Operating system resource management.

For repeatable experiments, use a separate browser profile or a test environment.

Keep the number of tabs bounded, provide a clear stop mechanism, and monitor system resource usage.

The repository is not intended to freeze, crash, or disrupt other people's browsers or computers.

🛠️ Troubleshooting

The redirect does not work

- Verify that PHP is enabled on the server.
- Check that "functions1.txt" is in the same directory as "index.php".
- Confirm that the configuration lines use the expected syntax.
- Make sure destination URLs use "https://".
- Check the browser's popup-blocking settings.

Local pages do not open

A local destination such as:

file:/index1.php/ | 95%

is interpreted by this implementation as a path on the same website.

The PHP file must exist at the corresponding web path.

Probabilities appear incorrect

Random selection does not guarantee the exact percentages on a small number of visits.

For example, a destination configured for 1% may be selected several times in a short sample, or not at all.

Larger samples generally provide a better indication of the configured distribution.

External websites behave unexpectedly

External destinations are outside the project's control. Their content, availability, redirects, and behavior may change.

Only configure destinations that you trust and intend to visit.

🔐 Security and Responsible Use

Use TabStorm only on websites and systems you own or have permission to test.

- Do not use the project to trick visitors into visiting deceptive websites.
- Do not use it to distribute malicious content.
- Do not create uncontrolled browser-opening loops.
- Do not attempt to bypass browser security restrictions.
- Do not collect sensitive information without a legitimate reason and appropriate consent.
- Clearly disclose unexpected redirects to users.
- Test changes in a controlled environment before deploying them publicly.

Remember that PHP executes on the server, while JavaScript executes in the visitor's browser. These environments have different permissions and security boundaries.

📄 License

Choose a license before distributing the project.

For example, the MIT License permits broad reuse with attribution, subject to its terms. Include the complete license text in a "LICENSE" file if you choose it.

---

Wersja polska

TabStorm — prosty system losowego przekierowywania w PHP i demonstracja zachowania przeglądarki.

TabStorm to eksperymentalny projekt internetowy wykorzystujący PHP, HTML i JavaScript. Pokazuje, jak konfigurować przekierowania URL, losować miejsca docelowe na podstawie prawdopodobieństwa i badać zachowanie przeglądarki.

Projekt jest przeznaczony do nauki, testów lokalnych i kontrolowanych demonstracji.

✨ Funkcje

- Losowe przekierowania: Wybór adresu na podstawie skonfigurowanych prawdopodobieństw.
- Konfiguracja tekstowa: Zmiana reguł bez edytowania kodu PHP.
- Wiele adresów: Obsługa lokalnych stron i zewnętrznych witryn.
- Reguła "+": Oznaczenie adresu, który ma być zawsze uwzględniony.
- Wartości dziesiętne: Obsługa wartości takich jak "94.5%" i "0.5%".
- Przetwarzanie po stronie serwera: Odczytywanie konfiguracji przez PHP.
- Demonstracje przeglądarki: Badanie wpływu dodatkowych kart na wydajność.
- Proste wdrożenie: Możliwość uruchomienia na standardowym serwerze obsługującym PHP.

💻 Wymagania

Potrzebujesz:

- Serwera WWW obsługującego PHP.
- Zalecany PHP w wersji 8.0 lub nowszej.
- Nowoczesnej przeglądarki z włączonym JavaScriptem.
- Dostępu do plików projektu.

Do testowania można wykorzystać lokalny serwer deweloperski PHP.

📦 Instalacja

1. Pobierz repozytorium.
2. Umieść pliki na serwerze obsługującym PHP.
3. Umieść "index.php" i "functions1.txt" w tym samym katalogu.
4. Upewnij się, że serwer może odczytać "functions1.txt".
5. Otwórz odpowiednią stronę w przeglądarce.

Ważne: Pliki PHP muszą być uruchamiane przez serwer PHP. Otwarcie ich bezpośrednio z dysku jako "file://" nie wykona kodu PHP.

⚙️ Konfiguracja

Reguły przekierowań znajdują się w pliku "functions1.txt".

Przykład:

file:/index1.php/ | 95%
https://example.com/ | 4%
https://example.org/ | 1%

Każdy wiersz zawiera adres docelowy oraz wartość reguły rozdzielone znakiem "|".

Reguły procentowe

Procent oznacza względną wagę danego adresu.

Przy konfiguracji:

file:/index1.php/ | 95%
https://example.com/ | 4%
https://example.org/ | 1%

zamierzony rozkład wygląda następująco:

Adres| Prawdopodobieństwo
"index1.php"| 95%
"example.com"| 4%
"example.org"| 1%

Są to prawdopodobieństwa, a nie gwarancje. Wyniki mogą się różnić przy kolejnych odwiedzinach.

Jeśli wartości nie sumują się do 100%, obecna implementacja traktuje je jako względne wagi i nie normalizuje ich automatycznie.

Wartości dziesiętne

Obsługiwane są również wartości dziesiętne:

file:/index1.php/ | 94.5%
https://example.com/ | 4.5%
https://example.org/ | 1%

Reguły "+"

Znak "+" oznacza, że dany adres jest zawsze uwzględniany:

file:/index1.php/ | +
https://example.com/ | +

Obecna implementacja próbuje otworzyć oba adresy.

Ograniczenie przeglądarki: Automatyczne otwieranie wielu kart może zostać zablokowane przez mechanizm ochrony przed wyskakującymi oknami.

Reguły "0%"

Reguła "0%" nie zostanie wybrana przez obecną implementację.

https://example.net/ | 0%

Może to służyć do tymczasowego wyłączenia adresu bez usuwania go z konfiguracji.

🔍 Jak działa projekt?

"index.php"

Skrypt PHP:

1. Odczytuje "functions1.txt".
2. Analizuje skonfigurowane adresy.
3. Oddziela reguły "+" od reguł procentowych.
4. Losuje adres na podstawie wag.
5. Przekazuje wybrane adresy do JavaScriptu.
6. Próbuje otworzyć je w nowych kartach przeglądarki.

"functions1.txt"

Plik przechowuje konfigurację przekierowań.

Oddzielenie konfiguracji od kodu PHP ułatwia zmianę adresów i ich prawdopodobieństw.

Przykładowy przebieg

Odwiedzający otwiera stronę startową.

Serwer odczytuje konfigurację i wybiera adres.

Przeglądarka otrzymuje stronę z kodem JavaScript odpowiedzialnym za otwarcie wybranego adresu.

W zależności od ustawień bezpieczeństwa przeglądarka może otworzyć go w nowej karcie.

🧪 Testowanie wydajności przeglądarki

TabStorm może być punktem wyjścia do eksperymentów z wydajnością przeglądarek.

Otwieranie dodatkowych kart może zwiększać zużycie pamięci RAM, procesora, sieci i zasobów odpowiedzialnych za renderowanie.

Wpływ zależy między innymi od:

- Dostępnej pamięci RAM.
- Ustawień i implementacji przeglądarki.
- Zawartości otwieranych stron.
- Zainstalowanych rozszerzeń.
- Możliwości sprzętu.
- Zarządzania zasobami przez system operacyjny.

Do powtarzalnych eksperymentów używaj osobnego profilu przeglądarki lub środowiska testowego.

Ogranicz liczbę kart, zapewnij możliwość zatrzymania testu i monitoruj wykorzystanie zasobów.

Projekt nie jest przeznaczony do zawieszania, zawalania ani zakłócania działania cudzych przeglądarek i komputerów.

🛠️ Rozwiązywanie problemów

Przekierowanie nie działa

- Sprawdź, czy serwer obsługuje PHP.
- Upewnij się, że "functions1.txt" znajduje się obok "index.php".
- Sprawdź poprawność składni reguł.
- Używaj "https://" w adresach zewnętrznych.
- Sprawdź ustawienia blokowania wyskakujących okien.

Lokalne strony nie otwierają się

Adres:

file:/index1.php/ | 95%

jest interpretowany przez tę implementację jako ścieżka w obrębie tej samej witryny.

Plik PHP musi istnieć pod odpowiadającą mu ścieżką internetową.

Prawdopodobieństwa wyglądają na nieprawidłowe

Losowanie nie gwarantuje uzyskania dokładnych procentów w niewielkiej liczbie prób.

Adres z prawdopodobieństwem 1% może zostać wybrany kilka razy w krótkiej serii albo nie zostać wybrany ani razu.

Większa liczba prób zazwyczaj lepiej pokazuje rzeczywisty rozkład losowania.

Zewnętrzne strony działają inaczej, niż oczekiwano

Projekt nie kontroluje zewnętrznych witryn. Ich zawartość, dostępność i przekierowania mogą się zmieniać.

Korzystaj wyłącznie z adresów, którym ufasz i które zamierzasz odwiedzać.

🔐 Bezpieczeństwo i odpowiedzialne użycie

Używaj TabStorm wyłącznie na stronach i systemach, które należą do Ciebie lub na których testowanie masz zgodę.

- Nie wykorzystuj projektu do nakłaniania użytkowników do odwiedzania oszukańczych witryn.
- Nie używaj go do rozpowszechniania złośliwej zawartości.
- Nie twórz niekontrolowanych pętli otwierających karty.
- Nie próbuj obchodzić zabezpieczeń przeglądarek.
- Nie zbieraj wrażliwych danych bez uzasadnionej potrzeby i odpowiedniej zgody.
- Informuj użytkowników o nieoczekiwanych przekierowaniach.
- Testuj zmiany w kontrolowanym środowisku przed publicznym wdrożeniem.

Pamiętaj, że PHP wykonuje się na serwerze, a JavaScript w przeglądarce odwiedzającego. Oba środowiska mają inne uprawnienia i granice bezpieczeństwa.

📄 Licencja

Przed rozpowszechnieniem projektu wybierz licencję.

Przykładowo licencja MIT pozwala na szerokie ponowne wykorzystanie kodu z zachowaniem jej warunków. Jeśli ją wybierzesz, umieść pełną treść licencji w pliku "LICENSE".