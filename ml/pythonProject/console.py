#!/usr/bin/env python

from cleo.application import Application

from app.module.popularity_forecast.application.command.PredictPopularityForecastCommand import \
    PredictPopularityForecastCommand


application = Application()
application.add(PredictPopularityForecastCommand())

if __name__ == "__main__":
    application.run()
