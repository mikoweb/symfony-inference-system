from numpy import ndarray
from pandas import DataFrame
from sklearn import linear_model
import numpy as np

from app.module.popularity_forecast.domain.PopularityForecastPredictorInterface import \
    PopularityForecastPredictorInterface


class PopularityForecastPredictor(PopularityForecastPredictorInterface):
    def __init__(self, sections: int, max_iter: int = 10):
        self.__sections = sections
        self.__max_iter = max_iter

    def predict(self, df: DataFrame, start_year: int, years_count: int) -> ndarray:
        df_len = len(df)
        clf = linear_model.BayesianRidge(max_iter=self.__max_iter)

        for part in np.array_split(range(df_len), self.__sections):
            start = part[0]
            end = part[len(part) - 1]
            df_range = df.iloc[start:end]

            clf.fit(
                [[int(year[0])] for year in df_range[0]],
                [float(value) for value in df_range[1]],
            )

        return clf.predict([[i + start_year] for i in range(years_count)])
