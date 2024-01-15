from cleo.commands.command import Command
from cleo.helpers import argument
import pandas as pd

from app.module.popularity_forecast.application.logic.PopularityForecastPredictor import PopularityForecastPredictor


class PredictPopularityForecastCommand(Command):
    name = 'app:predict:popularity-forecast'
    description = 'Predict Popularity Forecast'
    arguments = [
        argument('json_filename', description='Path to JSON file', optional=False),
        argument('result_json_filename', description='Path to result JSON file', optional=False),
        argument('start_year', description='Start year', optional=False),
        argument('years_count', description='Years count', optional=False),
        argument('sections', description='Number of sections - default 3', optional=True, default=3),
    ]

    def handle(self) -> int:
        json_file = self.argument('json_filename')
        start_year = int(self.argument('start_year'))
        years_count = int(self.argument('years_count'))
        sections = int(self.argument('sections'))
        result_json_filename = self.argument('result_json_filename')

        df = pd.read_json(json_file)

        predictor = PopularityForecastPredictor(sections)
        result = pd.DataFrame()

        for lang_name in df:
            lang_data = pd.DataFrame.from_records(df[lang_name])
            result[lang_name] = predictor.predict(lang_data, start_year, years_count)

        result.index = [start_year + i for i in range(years_count)]

        result.to_json(fr'{result_json_filename}')

        print(result)
        print('')
        print(f'File saved to: {result_json_filename}')
        print('')

        return 0
