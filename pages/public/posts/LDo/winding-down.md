Logger-Diary Online was my first big public project, but it's slowly becoming something else.

## History

The year is 2015, a CD drive is spinning. _MyLog231_ opens on the screen, running from the CD that was burned just two days ago.
I type,

```
MyLog works very well, I might start building more pretty CLI apps like this, but maybe the brown-on-white has to g
```
I enter, too soon. I run `edit.exe %cd%\mar.mylog` and add the rest of my journal text by hand:
```
o.
Maybe, I'll make a suite around it. MyLife231, with a calendar application working exactly the same as mylog.
```

Yes, the screenshot of the green-on-blue DOS-ish app is a sister project of the actual MyLog 231, as the original CD drive with MyLog231 on it is destroyed in a little accident in France, 2017.

MyLog231 comes back as a GUI app (`Logger-Diary Legacy`), but has several issues and is eventually succeeded by Logger-Diary Online.
But now...

## Present

### The codebase

Logger-Diary Online is still going strong, with many added features (Focus mode, theme preview picker, streaks) over the years. But... It is also becoming a burden.

Logger-Diary's base codebase is written over the course of two years, mainly because I couldn't make up my mind and wanted to implement hard stuff the easy way. It is, if anything, a mess.

It isn't unmanageable, but any attempt at a bigger reform will cause more issues than leaving it running. However, I don't have the time for either.

To keep logger-diary working, it needs small updates, which, due to the structure of its code at the moment always turn out to be gigantic updates. 

I have also been writing a new frontend for the Logger-Diary Cloud, able to connect to the server and even having a focus mode and emoji chooser, however, it couldn't quite erm, find its connection with the current sitting backend at the Logger-Diary Cloud: Logger-Diary Online.

### The financials

You might have noticed I removed Google from my sites, including analytics but mostly ads. This, because they insisted there was innapropriate content on my site (most likely, they referred to my trans-lesbian flag). I lost my ad revenue. I also didn't want to give anyone else control over my site, nor did I want to give my visitors virusses, so I did away completely with ads.

This hasn't changed anything, except that now I need to work more. I cannot keep up an immense codebase on my own, and though its back [on GitHub](https://github.com/strawmelonjuice/logger-diary-online/) (yeah, back, I did an oopsie.), I'm the only maintainer.

## Future

Moving on, Logger-Diary Online will slowly wind down. The Cloud-Client app will be remade into a new, better `Logger-Diary Desktop`. Online will get export functions that'll allow you to migrate to the new desktop app and when ready, it will slowly die.

A new Logger-Diary Cloud will eventually be made, but for now, that metal-colored cloud icon will dissapear. Until ready.
