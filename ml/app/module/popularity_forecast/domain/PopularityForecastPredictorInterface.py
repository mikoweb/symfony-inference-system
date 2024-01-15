from abc import ABC, abstractmethod
from numpy import ndarray
from pandas import DataFrame


class PopularityForecastPredictorInterface(ABC):
    @abstractmethod
    def predict(self, df: DataFrame, start_year: int, years_count: int) -> ndarray:
        raise NotImplementedError
