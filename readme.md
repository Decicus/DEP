# DEP (Discord Emotes Proxy)
A proxy which should embed both Twitch emotes and BetterTTV emotes properly in Discord.

## About
This is a very basic web application built on top of [Lumen](https://lumen.laravel.com/).

All it really does is proxy Twitch and BetterTTV emotes, based off the size and ID of the emote, by specifying the correct headers and extension.

This was primarily built to be used by [DEB (Discord Emotes Bot)](https://github.com/Decicus/DEB).

## Routes
- `/t/{SIZE}/{ID}` - For Twitch emotes
    - `{SIZE}` can be a number between 1 and 3. Where 1 is the smallest and 3 is the largest.
    - `{ID}` is the numeric ID of the emote.
        - Example: `25` (Kappa) = ![Kappa](https://static-cdn.jtvnw.net/emoticons/v1/25/1.0)
- `/b/{SIZE}/{ID}.{EXT}` - For BetterTTV emotes
    - `{SIZE}` works exactly like the one for Twitch emotes.
    - `{ID}` is the unique ID of the emote.
        - Example: `566c9fde65dbbdab32ec053e` (FeelsGoodMan) = ![FeelsGoodMan](https://cdn.betterttv.net/emote/566c9fde65dbbdab32ec053e/1x)
    - `{EXT}` is the extension of the emote. Currently only `png` or `gif`.
        - If the extension doesn't match either `png` or `gif`, it defaults to `png`.

## Notes
- If an invalid emote ID is specified, it defaults to this: ![Kappa](https://static-cdn.jtvnw.net/emoticons/v1/25/1.0)

## License
[MIT License](LICENSE)
